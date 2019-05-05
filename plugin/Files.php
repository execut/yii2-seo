<?php
/**
 */

namespace execut\seo\plugin;

use execut\files\models\File;
use execut\files\plugin\seo\models\KeywordVsFile;
use execut\seo\Plugin;

class Files implements Plugin
{
    public function getKeywordsModels()
    {
        return [
            File::class,
        ];
    }

    public function getFieldsModels()
    {
        return [];
    }

    public function getKeywordFieldsPlugins() {
        return [
            [
                'class' => \execut\files\crudFields\FilesPlugin::class,
                'linkAttribute' => 'seo_keyword_id',
                'vsModelClass' => KeywordVsFile::class,
            ],
        ];
    }
}