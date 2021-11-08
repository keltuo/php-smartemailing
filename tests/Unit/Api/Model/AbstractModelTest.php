<?php

namespace SmartEmailing\Test\Unit\Api\Model;

use PHPUnit\Framework\TestCase;
use SmartEmailing\Api\Model\AbstractModel;
use SmartEmailing\Test\Mock\AbstractModelMock;

class AbstractModelTest extends TestCase
{
    protected AbstractModel $abstractClass;

    protected array $expectedData = [ // constructor $data
        'name' => 'set name value',
        'value' => 'set string value',
        'snake_case_camel_case' => 'snake case camel case value',
        'propertyWithoutSetter' => 'property without setter',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $this->abstractClass = $this->getMockForAbstractClass(AbstractModelMock::class);
        $this->abstractClass->setPropertiesFromArr($this->expectedData);
    }

    public function testSetData()
    {
        $this->assertEquals('set name value', $this->abstractClass->getName());
        $this->assertEquals('set string value', $this->abstractClass->getValue());
        $this->assertEquals('snake case camel case value', $this->abstractClass->getSnakeCaseCamelCase());

        $this->abstractClass->setName('Change name value');
        $this->abstractClass->setPropertiesFromArr($this->expectedData, ['name']);

        $this->assertEquals('Change name value', $this->abstractClass->getName());
        $this->assertEquals('set string value', $this->abstractClass->getValue());
        $this->assertEquals('snake case camel case value', $this->abstractClass->getSnakeCaseCamelCase());

    }

    public function testJsonSerialize()
    {
        $expectedData = [
            'name_sm' => 'set name value',
            'value_sm' => 'set string value',
            'snake_sm' => 'snake case camel case value'
        ];
        $this->assertEquals($expectedData, $this->abstractClass->jsonSerialize());
        $this->assertEquals(json_encode($expectedData), json_encode($this->abstractClass));
    }

    public function testToArray()
    {
        $expectedData = [
            'name_sm' => 'set name value',
            'value_sm' => 'set string value',
            'snake_sm' => 'snake case camel case value'
        ];
        $this->assertEquals($expectedData, $this->abstractClass->toArray());
    }

    public function test__toString()
    {
        $expectedData = [
            'name_sm' => 'set name value',
            'value_sm' => 'set string value',
            'snake_sm' => 'snake case camel case value'
        ];
        $this->assertEquals(json_encode($expectedData), (string)$this->abstractClass);
    }
}
