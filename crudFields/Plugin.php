<?php
/**
 */

namespace execut\seo\crudFields;


use execut\crudFields\fields\Editor;
class Plugin extends \execut\crudFields\Plugin
{
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