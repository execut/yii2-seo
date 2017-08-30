<?php
/**
 */

namespace execut\seo\migrations;


use execut\yii\migration\Table;
use yii\base\Object;

class AddFieldsHelper extends Object
{
    /**
     * @var Table
     */
    public $table = null;
    public $inverter = null;
    public function attach() {
        $this->table->addColumns([
            'title' => $this->table->migration->string(),
            'description' => $this->table->migration->string(),
            'keywords' => $this->table->migration->text(),
            'header' => $this->table->migration->string(),
            'text' => $this->table->migration->text(),
        ]);
    }

    public function attachKeywords() {
        $keyWordsTableName = $this->table->name . '_vs_seo_keywords';
        $this->inverter->table($keyWordsTableName)->create([
            'title' => $this->table->migration->string(),
            'description' => $this->table->migration->string(),
            'keywords' => $this->table->migration->text(),
            'header' => $this->table->migration->string(),
            'text' => $this->table->migration->text(),
        ]);
    }
}

/**
 * create table seo_words
(
id serial not null
constraint seo_words_pkey
primary key,
name varchar(255),
popularity bigint,
results_count bigint,
keywords_count bigint,
created_at timestamp(0) default now() not null,
updated_at timestamp(0)
)
;
 */