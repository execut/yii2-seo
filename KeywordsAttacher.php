<?php
/**
 */

namespace execut\seo;


use execut\seo\migrations\AddFieldsHelper;
use execut\seo\migrations\AddKeywordsHelper;
use execut\yii\migration\Attacher;
use execut\yii\migration\Inverter;
use execut\yii\migration\Migration;

class KeywordsAttacher extends Attacher
{
    public $tables = [];

    protected function getVariations () {
        return ['tables'];
    }

    public function initInverter(Inverter $i) {
        foreach ($this->tables as $table) {
            $tableSchema = $this->db->getTableSchema($table);
            if (!$tableSchema) {
                continue;
            }

            $helper = new AddKeywordsHelper([
                'targetTable' => $i->table($table),
            ]);

            $tableSchema = $this->db->getTableSchema($helper->getTargetTableName());
            if (!$tableSchema) {
                $helper->attach();
            }
        }
    }
}