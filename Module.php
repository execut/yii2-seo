<?php
/**
 */

namespace execut\seo;
use execut\dependencies\PluginBehavior;

class Module extends \yii\base\Module implements Plugin
{
    public function behaviors()
    {
        return [
            [
                'class' => PluginBehavior::class,
                'pluginInterface' => Plugin::class,
            ],
        ];
    }

    public function getKeywordsModels() {
        $results = $this->getPluginsResults(__FUNCTION__);
        if (empty($results)) {
            $results = [];
        }

        return $results;
    }

    public function getFieldsModels() {
        $results = $this->getPluginsResults(__FUNCTION__);
        if (empty($results)) {
            $results = [];
        }

        return $results;
    }

    public function getKeywordFieldsPlugins() {
        $results = $this->getPluginsResults(__FUNCTION__);
        if (empty($results)) {
            $results = [];
        }

        return $results;
    }
}