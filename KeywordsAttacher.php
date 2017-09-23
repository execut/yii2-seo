<?php
/**
 */

namespace execut\seo;


use execut\seo\migrations\AddFieldsHelper;
use execut\seo\migrations\AddKeywordsHelper;
use execut\yii\migration\Inverter;
use execut\yii\migration\Migration;

class KeywordsAttacher extends Migration
{
    public $tables = [];
    public function initInverter(Inverter $i) {
        foreach ($this->tables as $table) {
            $cache = \yii::$app->cache;

            foreach ($this->tables as $table) {
                $cacheKey = __CLASS__ . '_' . $table;
                if ($cache->get($cacheKey)) {
                    continue;
                }

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

                $cache->set($cacheKey, 1);
            }
        }
    }
}