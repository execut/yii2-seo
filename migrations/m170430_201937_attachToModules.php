<?php

use execut\yii\migration\Migration;
use execut\yii\migration\Inverter;

class m170430_201937_attachToModules extends Migration
{
    public function initInverter(Inverter $i)
    {
        $helper = new \execut\seo\migrations\AddFieldsHelper();
        $module = \yii::$app->getModule('seo');
        foreach ($module->getModels() as $model) {
            $helper->table = $i->table($model::tableName());
            $helper->attach();
        }
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
