<?php
/**
 */

namespace execut\seo\crudFields;
use execut\crudFields\fields\HasManyMultipleInput;
use execut\crudFields\fields\HasManySelect2;
use execut\seo\KeywordsAttacher;
use execut\seo\models\Keyword;
use execut\seo\models\KeywordVsPage;
use yii\helpers\Inflector;

class Keywords extends \execut\crudFields\Plugin
{
    public $linkAttribute = null;
    public $vsModelClass = null;
    public function getFields() {
        return [
            'seoKeywords' => [
                'class' => HasManyMultipleInput::class,
                'attribute' => 'seoKeywords',
                'relation' => 'seoKeywords',
                'module' => 'seo',
                'url' => [
                    '/seo/keywords'
                ],
            ],
        ];
    }

    public function attach()
    {
        parent::attach();
        $attacher = new KeywordsAttacher([
            'tables' => [
                $this->getOwnerTableName()
            ],
        ]);
        $attacher->safeUp();
    }

    public function getRelations()
    {
        return [
            'seoKeywords' => [
               'class' => Keyword::class,
               'name' => 'seoKeywords',
               'link' => [
                   'id' => 'seo_keyword_id',
               ],
                'via' => 'vsSeoKeywords',
//                'viaTable' => 'seo_keywords_vs_' . $this->getOwnerTableName(),
//                'viaLink' => [
//                    'seo_keyword_id' => 'id',
//                ],
                'multiple' => true
            ],
            'vsSeoKeywords' => [
                'class' => $this->vsModelClass,
                'name' => 'vsSeoKeywords',
                'link' => [
                    $this->linkAttribute => 'id',
                ],
                'multiple' => true
            ],
        ];
    }

    protected function getOwnerTableName() {
        return $this->owner->tableName();
    }

    protected function getOwnerForeignKey() {
        $tableName = $this->getOwnerTableName();

        return Inflector::singularize($tableName) . '_id';
    }
}