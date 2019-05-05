<?php
/**
 */

namespace execut\seo\bootstrap;


use execut\crud\navigation\Configurator;
use execut\seo\models\Keyword;
use execut\seo\Module;
use execut\yii\Bootstrap;
use yii\helpers\ArrayHelper;

class Backend extends Common
{
    public $isBootstrapI18n = true;
    public function getDefaultDepends() {
        return ArrayHelper::merge(parent::getDefaultDepends(), [
            'bootstrap' => [
                'crud' => [
                    'class' => \execut\crud\Bootstrap::class,
                ],
                'navigation' => [
                    'class' => \execut\navigation\Bootstrap::class,
                ],
            ],
        ]);
    }

    /**
     * @param \yii\base\Application $app
     */
    public function bootstrap($app)
    {
        parent::bootstrap($app);
        $this->bootstrapNavigation($app);
    }

    /**
     * @param $app
     */
    protected function bootstrapNavigation($app)
    {
        $module = $app->getModule('seo');
        if (!(!$app->user->isGuest && $module->adminRole === '@') && !$app->user->can($module->adminRole)) {
            return;
        }

        /**
         * @var Component $navigation
         */
        $navigation = $app->navigation;
        $models = [
            'keyword' => Keyword::MODEL_NAME,
        ];
        foreach ($models as $model => $modelName) {
            $navigation->addConfigurator([
                'class' => Configurator::class,
                'module' => 'seo',
                'moduleName' => 'Seo',
                'modelName' => $modelName,
                'controller' => $model . 's',
            ]);
        }
    }
}