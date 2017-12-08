<?php
/**
 */

namespace execut\seo\migrations;


use execut\yii\migration\MigrationTrait;
use yii\base\BaseObject;
use yii\helpers\Inflector;

class AddKeywordsHelper extends BaseObject
{
    public $targetTable = null;
    public function attach() {
        $targetTable = $this->getTargetTableName();
        $migration = $this->targetTable->migration;
        $migration
            ->table($targetTable)
            ->create($migration->defaultColumns())
            ->addForeignColumn('seo_keywords', true)
            ->addForeignColumn($this->targetTable->name, true)
            ->createIndex(['seo_keyword_id', Inflector::singularize($this->targetTable->name) . '_id'], true);
    }

    /**
     * @return mixed
     */
    public function getTargetTableName()
    {
        $targetTable = 'seo_keywords_vs_' . $this->targetTable->name;
        return $targetTable;
    }
}