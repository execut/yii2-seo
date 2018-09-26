<?php
/**
 * Created by PhpStorm.
 * User: execut
 * Date: 9/18/18
 * Time: 9:34 AM
 */

namespace execut\seo\navigation;


use execut\navigation\BasePage;
use yii\base\BaseObject;

class Page extends BaseObject implements BasePage
{
    public $model = null;
    public $route = null;

    /**
     * @return null
     */
    public function getKeywords() {
        return [];
    }

    /**
     * @return null
     */
    public function getUrl() {
        return [
            $this->route,
            'id' => $this->model->id,
        ];
    }

    /**
     * @return null
     */
    public function getName() {
        return $this->model->name;
    }

    /**
     * @return null
     */
    public function getHeader() {
        return $this->model->header;
    }

    /**
     * @return null
     */
    public function getText() {
        return $this->model->text;
    }

    /**
     * @return null
     */
    public function getDescription() {
        return $this->model->description;
    }

    /**
     * @return null
     */
    public function getTitle() {
        return $this->model->title;
    }

    protected $_parentPage;
    /**
     * @return self
     */
    public function getParentPage() {
        return $this->_parentPage;
    }

    public function setParentPage($page) {
        $this->_parentPage = $page;
    }
}