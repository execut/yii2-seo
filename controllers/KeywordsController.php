<?php
/**
 */

namespace execut\seo\controllers;


use execut\crud\params\Crud;
use execut\seo\models\Keyword;
use yii\filters\AccessControl;
use yii\web\Controller;

class KeywordsController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => [$this->module->adminRole],
                    ],
                ],
            ],
        ];
    }

    public function actions()
    {
        return \yii::createObject([
            'class' => Crud::class,
            'modelClass' => Keyword::class,
            'module' => 'seo',
            'moduleName' => 'Keywords',
            'modelName' => Keyword::MODEL_NAME,
        ])->actions();
    }
}