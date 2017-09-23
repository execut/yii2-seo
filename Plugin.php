<?php
/**
 */

namespace execut\seo;


interface Plugin
{
    public function getKeywordsModels();
    public function getFieldsModels();
    public function getKeywordFieldsPlugins();
}