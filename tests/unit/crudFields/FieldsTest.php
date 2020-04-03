<?php
/**
 */

namespace execut\seo\crudFields;


use execut\crudFields\Behavior;
use execut\crudFields\fields\detailViewField\addon\Help;
use execut\crudFields\fields\Editor;
use PHPUnit\Framework\TestCase;
use yii\base\Model;

class FieldsTest extends TestCase
{
    public function testTextField() {
        $behavior = new Behavior();
        $fields = new Fields();
        $behavior->setPlugins([
            'seo' => $fields,
        ]);
        $text = $behavior->getField('text');
        $this->assertInstanceOf(Editor::class, $text);
        $addon = $text->getDetailViewField()->getAddon();
        $this->assertNull($addon);
    }
    public function testTextFieldWithHelp() {
        $behavior = new Behavior();
        $fields = new Fields([
            'varsList' => [
                'testVar' => 'testVarDescription'
            ]
        ]);
        $behavior->setPlugins([
            'seo' => $fields,
        ]);
        $text = $behavior->getField('text');
        $help = $text->getDetailViewField()->getAddon();
        $this->assertInstanceOf(Help::class, $help);
        $this->assertEquals('<ul><li>{testVar} - testVarDescription</li></ul>', str_replace("\n", '', $help->getText()->getValue()));
    }
}

class FieldsTestModel extends Model {

}