<?php
/**
 */

namespace execut\seo;


use execut\seo\migrations\AddFieldsHelper;
use execut\yii\migration\Inverter;
use execut\yii\migration\Migration;

class FieldsAttacher extends Migration
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

                $isAttached = $tableSchema->getColumn('description');
                if (!$isAttached) {
                    $helper = new AddFieldsHelper([
                        'table' => $i->table($table),
                    ]);
                    $helper->attach();
                }

                $cache->set($cacheKey, 1);
            }
        }
    }
}