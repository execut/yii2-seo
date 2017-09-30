<?php
/**
 */

namespace execut\seo;


use execut\seo\migrations\AddFieldsHelper;
use execut\yii\migration\Attacher;
use execut\yii\migration\Inverter;
use execut\yii\migration\Migration;

class FieldsAttacher extends Attacher
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

            $isAttached = $tableSchema->getColumn('description');
            if (!$isAttached) {
                $helper = new AddFieldsHelper([
                    'table' => $i->table($table),
                ]);
                $helper->attach();
            }
        }
    }
}