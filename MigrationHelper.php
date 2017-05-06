<?php
/**
 */

namespace execut\seo;


use execut\yii\migration\Table;
use yii\base\Object;

class MigrationHelper extends Object
{
    /**
     * @var Table
     */
    public $table = null;
    public function attach() {
        $this->table->addColumns([
            'title' => $this->table->migration->string(),
            'description' => $this->table->migration->string(),
            'keywords' => $this->table->migration->string(),
            'header' => $this->table->migration->string(),
            'text' => $this->table->migration->string(),
        ]);
    }
}