<?php
/**
 */

namespace execut\seo;


use conquer\helpers\XPath;
use yii\base\BaseObject;
use yii\helpers\Html;

class TextReplacer extends BaseObject
{
    public $text = null;
    public $keyword = null;
    public $href = null;
    public $title = null;
    public $limit = false;
    public $img = null;
    public $imgAlt = null;
    public $replacedCount = 0;
    public function replace() {
        $xpath = $this->getDomDocumentFromText();

        $elementsList = $xpath->query('/html/body/p/text()', null, false);
        if ($elementsList === null) {
            return $this->text;
        }

        $totalReplaced = 0;
        $textNodes = [];
        for ($key = 0; $key < $elementsList->length; $key++) {
            $textNodes[] = $elementsList->item($key);
        }

        foreach ($textNodes as $textElement) {
            $pattern = '/(?<=[^a-z]|^)' . preg_quote($this->keyword) . '(?=[^a-z]|$)/im';
            /**
             * @var \DOMElement $element
             */
            $element = $textElement->parentNode;
            preg_match_all($pattern, $textElement->nodeValue, $matches);
            foreach ($matches[0] as $currentMatch => $match) {
                if ($this->limit !== false && $totalReplaced > $this->limit - 1) {
                    break;
                }

                $totalReplaced++;
                $this->replacedCount++;
                $template = preg_replace($pattern, '{keyword}', $textElement->nodeValue, 1);
                $parts = explode('{keyword}', $template, 2);
                if (!empty($parts[1])) {
                    $textElement->nodeValue = $parts[1];
                } else {
                    $textElement->nodeValue = '';
                }

                $keywordElement = $xpath->getDoc()->createElement($this->getTag(), $match);
                foreach ($this->getTagAttributes() as $attribute => $value) {
                    $keywordElement->setAttribute($attribute, $value);
                }

                if (!empty($parts[0])) {
                    $beforeTextElement = $xpath->getDoc()->createTextNode($parts[0]);
                    $element->insertBefore($beforeTextElement, $textElement);
                }

                $element->insertBefore($keywordElement, $textElement);

                if ($this->img !== null) {
                    $imgElement = $xpath->getDoc()->createElement('img', $match);
                    $imgElement->setAttribute('src', $this->img);
                    if ($this->imgAlt !== null) {
                        $imgElement->setAttribute('alt', $this->imgAlt);
                    }

                    if ($this->getTag() === 'a') {
                        $hrefElement = $xpath->getDoc()->createElement('a');
                        foreach ($this->getTagAttributes() as $attribute => $value) {
                            $hrefElement->setAttribute($attribute, $value);
                        }

                        $hrefElement->appendChild($imgElement);
                        $element->parentNode->insertBefore($hrefElement, $element);
                    } else {
                        $element->parentNode->insertBefore($imgElement, $element);
                    }
                }
            }
        }

        $doc = $xpath->getDoc();

        $result = $doc->saveHTML();

        $result = str_replace([
            "<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\" \"http://www.w3.org/TR/REC-html40/loose.dtd\">\n<html><body>",
            "</body></html>\n"
        ], '', $result);

        return $result;
    }

    protected function getTag() {
        if ($this->href === null) {
            return 'strong';
        } else {
            return 'a';
        }
    }

    protected function getTagAttributes() {
        if ($this->href === null) {
            return [];
        } else {
            return [
                'href' => $this->href,
                'title' => $this->title,
            ];
        }
    }

    protected function getDomDocumentFromText() {
        $xpath = new XPath('<?xml encoding="utf-8" ?>' . $this->text, true);
        return $xpath;
    }
}