<?php

use execut\yii\migration\Migration;
use execut\yii\migration\Inverter;

class m170829_151236_addKeywordsToModules extends Migration
{
    public function initInverter(Inverter $i)
    {
        $helper = new \execut\seo\migrations\AddKeywordsHelper();
        $helper->migration = $i;
        $i->table('seo_keywords')->create($this->defaultColumns([
            'name' => $this->string()->notNull(),
            'popularity' => $this->integer()->unsigned(),
            'results_count' => $this->bigInteger()->unsigned(),
            'words_count' => $this->integer()->unsigned(),
        ]))->createIndex('name', true);
        $module = \yii::$app->getModule('seo');
        foreach ($module->getModels() as $model) {
            $helper->targetTable = $i->table($model::tableName());
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
