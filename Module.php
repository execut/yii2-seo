<?php
/**
 */

namespace execut\seo;
use execut\dependencies\PluginBehavior;

class Module extends \yii\base\Module implements Plugin
{
    public $models = [];
    public function behaviors()
    {
        return [
            [
                'class' => PluginBehavior::class,
                'pluginInterface' => Plugin::class,
            ],
        ];
    }

    public function getModels() {
        return array_merge($this->getPluginsResults(__FUNCTION__), $this->models);
    }
}