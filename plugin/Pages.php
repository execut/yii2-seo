<?php
/**
 */

namespace execut\seo\plugin;


use execut\pages\models\Page;
use execut\seo\Plugin;
use execut\seo\plugin\pages\models\KeywordVsPage;

class Pages implements Plugin
{
    public function getKeywordsModels()
    {
        return [
            Page::class,
        ];
    }

    public function getFieldsModels()
    {
        return [
            Page::class,
        ];
    }

    public function getKeywordFieldsPlugins() {
        return [
            [
                'class' => \execut\pages\crudFields\VsPagesPlugin::class,
                'linkAttribute' => 'seo_keyword_id',
                'vsModelClass' => KeywordVsPage::class,
            ],
        ];
    }
}