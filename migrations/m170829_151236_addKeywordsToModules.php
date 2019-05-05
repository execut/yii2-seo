<?php
namespace execut\seo\migrations;
use execut\yii\migration\Migration;
use execut\yii\migration\Inverter;

class m170829_151236_addKeywordsToModules extends Migration
{
    public function initInverter(Inverter $i)
    {
        $i->table('seo_keywords')->create($this->defaultColumns([
            'name' => $this->string()->notNull(),
            'popularity' => $this->integer()->unsigned(),
            'results_count' => $this->bigInteger()->unsigned(),
            'words_count' => $this->integer()->unsigned(),
        ]))->createIndex('name', true);
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
