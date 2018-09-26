<?php
/**
 */

namespace execut\seo\bootstrap;


use execut\seo\FieldsAttacher;
use execut\seo\KeywordsAttacher;
use execut\seo\Module;
use execut\yii\Bootstrap;

class Common extends Bootstrap
{
    protected $isBootstrapI18n = true;
    public $_defaultDepends = [
        'modules' => [
            'seo' => [
                'class' => Module::class,
            ],
        ],
    ];
}