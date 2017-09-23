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

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub


    }

    public function getKeywordsModels() {
        return array_merge($this->getPluginsResults(__FUNCTION__));
    }

    public function getFieldsModels() {
        return array_merge($this->getPluginsResults(__FUNCTION__));
    }

    public function getKeywordFieldsPlugins() {
        return array_merge($this->getPluginsResults(__FUNCTION__));
    }
}