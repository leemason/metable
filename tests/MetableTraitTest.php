<?php

class MetableTraitTest extends PHPUnit_Framework_TestCase{

    public function testIntReturnValue()
    {
        $model = new \LeeMason\Metable\MetaModel();
        $model->key = 'new_int';
        $model->value = 4;

        $this->assertInternalType('int', $model->value);
    }

    public function testFloatReturnValue()
    {
        $model = new \LeeMason\Metable\MetaModel();
        $model->key = 'new_float';
        $model->value = 4.45;

        $this->assertInternalType('float', $model->value);
    }

    public function testBoolReturnValue()
    {
        $model = new \LeeMason\Metable\MetaModel();
        $model->key = 'new_bool';
        $model->value = true;

        $this->assertTrue($model->value);

        $model->value = false;

        $this->assertFalse($model->value);
    }

    public function testObjectReturnValue()
    {
        $model = new \LeeMason\Metable\MetaModel();
        $model->key = 'new_object';
        $model->value = new stdClass();

        $this->assertInstanceOf('stdClass', $model->value);
    }

    public function testCollectionReturnValue()
    {
        $model = new \LeeMason\Metable\MetaModel();
        $model->key = 'new_collection';
        $model->value = new \Illuminate\Support\Collection();

        $this->assertInstanceOf('Illuminate\Support\Collection', $model->value);
    }

    public function testArrayReturnValue()
    {
        $model = new \LeeMason\Metable\MetaModel();
        $model->key = 'new_array';
        $model->value = ['1', '2'];

        $this->assertTrue(is_array($model->value));
    }

    public function testStringReturnValue()
    {
        $model = new \LeeMason\Metable\MetaModel();
        $model->key = 'new_string';
        $model->value = 'some string';

        $this->assertTrue(is_string($model->value));
    }
}