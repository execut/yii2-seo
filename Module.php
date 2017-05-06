<?php
/**
 */

namespace execut\seo;
use execut\dependencies\PluginBehavior;

class Module extends \yii\base\Module implements Plugin
{
    public $attachedModels = [];
    public function behaviors()
    {
        return [
            'class' => PluginBehavior::class,
//            'pluginInterface' => Plugin::class,
        ];
    }

    public function getModels() {
        return $this->getPluginsResults(__FUNCTION__);
    }
}