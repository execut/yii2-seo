<?php
/**
 */

namespace execut\seo\crudFields;


use execut\crudFields\fields\Boolean;
use execut\crudFields\fields\detailViewField\addon\Help;
use execut\crudFields\fields\detailViewField\addon\help\text\Simple;
use execut\crudFields\fields\detailViewField\addon\help\text\VarsList;
use execut\crudFields\fields\Editor;
use execut\crudFields\fields\Group;
use execut\crudFields\fields\RawField;
use execut\crudFields\fields\StringField;
use execut\seo\FieldsAttacher;
use yii\helpers\Html;

class Fields extends \execut\crudFields\Plugin
{
    public $varsList = [];
    protected function _getFields() {
        $textField = new Editor([
            'module' => 'seo',
            'attribute' => 'text',
        ]);

        if ($this->varsList) {
            $varsList = [];
            foreach ($this->varsList as $key => $description) {
                $varsList['{' . $key . '}'] = $description;
            }

            $detailViewField = $textField->getDetailViewField();
            $textHelpAddon = new VarsList('', $varsList);
            $helpAddon = new Help($textHelpAddon);
            $detailViewField->setAddon($helpAddon);
        }

        $fields = [
            'seoGroup' => [
                'class' => Group::class,
                'module' => 'seo',
                'label' => 'Seo',
            ],
            'header' => [
                'class' => StringField::class,
                'module' => 'seo',
                'attribute' => 'header',
            ],
            'title' => [
                'class' => StringField::class,
                'module' => 'seo',
                'attribute' => 'title',
            ],
            'description' => [
                'class' => StringField::class,
                'module' => 'seo',
                'attribute' => 'description',
            ],
            'keywords' => [
                'class' => StringField::class,
                'module' => 'seo',
                'attribute' => 'keywords',
            ],
            'text' => $textField,
            'no_index' => [
                'class' => Boolean::class,
                'module' => 'seo',
                'attribute' => 'no_index',
            ],
        ];

        return $fields;
    }
}