<?php
/**
 */

namespace execut\seo\tests\unit;


use execut\seo\TextReplacer;

class TextReplacerTest extends \PHPUnit_Framework_TestCase
{
    public function testReplaceKeywordToStrong() {
        $replacer = new TextReplacer([
            'text' => '<p>text before Keyword. text after next keyword. tskippedkeyword. keyword.skipped</p>',
            'keyword' => 'Keyword.',
        ]);

        $this->assertEquals('<p>text before <strong>Keyword.</strong> text after next <strong>keyword.</strong> tskippedkeyword. keyword.skipped</p>', $replacer->replace());
    }

    public function testReplaceKeywordToLink() {
        $replacer = new TextReplacer([
            'text' => '<p>text before Keyword. text after next keyword.</p>',
            'keyword' => 'Keyword.',
            'title' => 'keyword title',
            'href' => '/test',
            'limit' => 1,
        ]);

        $this->assertEquals('<p>text before <a href="/test" title="keyword title">Keyword.</a> text after next keyword.</p>', $replacer->replace());
    }

    public function testReplaceKeywordToImg() {
        $replacer = new TextReplacer([
            'text' => '<p>Keyword.</p>',
            'keyword' => 'Keyword.',
            'img' => '/test-img.jpg',
            'imgAlt' => 'img alt',
            'title' => 'keyword title',
            'href' => '/test',
            'limit' => 1,
        ]);

        $this->assertEquals('<a href="/test" title="keyword title"><img src="/test-img.jpg" alt="img alt"></a><p><a href="/test" title="keyword title">Keyword.</a></p>', $replacer->replace());
    }
}