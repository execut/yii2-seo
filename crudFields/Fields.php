<?php
/**
 */

namespace execut\seo\crudFields;


use execut\crudFields\fields\Editor;
use execut\crudFields\fields\Group;
use execut\crudFields\fields\StringField;
use execut\seo\FieldsAttacher;

class Fields extends \execut\crudFields\Plugin
{
    public function getFields() {
        $helper = new FieldsAttacher([
            'tables' => [
                $this->owner->owner->tableName(),
            ],
        ]);
        $helper->up();

        return [
            [
                'class' => Group::class,
                'module' => 'seo',
                'label' => 'Seo',
            ],
            [
                'class' => StringField::class,
                'module' => 'seo',
                'attribute' => 'header',
            ],
            [
                'class' => StringField::class,
                'module' => 'seo',
                'attribute' => 'title',
            ],
            [
                'class' => StringField::class,
                'module' => 'seo',
                'attribute' => 'description',
            ],
            [
                'class' => StringField::class,
                'module' => 'seo',
                'attribute' => 'keywords',
            ],
            [
                'module' => 'seo',
                'class' => Editor::class,
                'attribute' => 'text',
            ],
        ];
    }
}