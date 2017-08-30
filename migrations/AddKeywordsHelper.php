<?php
/**
 */

namespace execut\seo\migrations;


use execut\yii\migration\MigrationTrait;
use yii\base\Object;
use yii\helpers\Inflector;

class AddKeywordsHelper extends Object
{
    public $targetTable = null;
    /**
     * @var MigrationTrait
     */
    public $migration = null;
    public function attach() {
        $targetTable = $this->targetTable->name;
        $this->migration
            ->table('seo_keywords_vs_' . $targetTable)
            ->create($this->migration->defaultColumns())
            ->addForeignColumn('seo_keywords', true)
            ->addForeignColumn($targetTable, true)
            ->createIndex(['seo_keyword_id', Inflector::singularize($targetTable) . '_id'], true);
    }
}