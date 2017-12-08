<?php
/**
 */

namespace execut\seo\migrations;


use execut\yii\migration\Table;
use yii\base\BaseObject;

class AddFieldsHelper extends BaseObject
{
    /**
     * @var Table
     */
    public $table = null;
    public function attach() {
        $this->table->addColumns([
            'title' => $this->table->migration->string(),
            'description' => $this->table->migration->string(),
            'keywords' => $this->table->migration->text(),
            'header' => $this->table->migration->string(),
            'text' => $this->table->migration->text(),
        ]);
    }
}