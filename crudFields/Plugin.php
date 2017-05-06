<?php
/**
 */

namespace execut\seo\crudFields;


use execut\crudFields\fields\Editor;
class Plugin
{
    public $owner = null;
    public function getFields() {

        return [
            [
                'attribute' => 'header',
            ],
            [
                'attribute' => 'title',
            ],
            [
                'attribute' => 'description',
            ],
            [
                'attribute' => 'keywords',
            ],
            [
                'class' => Editor::class,
                'attribute' => 'text',
            ],
        ];
    }
}