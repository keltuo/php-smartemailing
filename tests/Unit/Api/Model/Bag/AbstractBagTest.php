<?php

namespace SmartEmailing\Test\Unit\Api\Model\Bag;

use PHPUnit\Framework\TestCase;
use SmartEmailing\Test\Mock\AbstractBagMock;
use SmartEmailing\Test\Mock\AbstractModelMock;

class AbstractBagTest extends TestCase
{
    protected AbstractBagMock $abstractClass;

    public function setUp(): void
    {
        parent::setUp();
        $this->abstractClass = $this->getMockForAbstractClass(AbstractBagMock::class);
    }

    public function testBaseMethods()
    {
        $item = $this->abstractClass->get(0);
        $this->assertNull($item);
        $this->assertTrue($this->abstractClass->isEmpty());

        $this->abstractClass->create('indexName', 'item value');
        $this->assertEquals([
            'name_sm' => 'indexName',
            'value_sm' => 'item value',
            'snake_sm' => null
        ], $this->abstractClass->get(0)->toArray());
        $this->abstractClass->create('indexName', 'item value');
        $this->assertEquals(1, $this->abstractClass->count());
        $this->assertCount(1, $this->abstractClass->getItems());
        $this->assertEquals([
            (new AbstractModelMock)->setPropertiesFromArr([
                'name' => 'indexName',
                'value' => 'item value'
            ])
        ], $this->abstractClass->toArray());
        $this->assertEquals(json_encode([
            (new AbstractModelMock)->setPropertiesFromArr([
                'name' => 'indexName',
                'value' => 'item value'
            ])
        ]), json_encode($this->abstractClass));
        $this->assertEquals(json_encode([
            (new AbstractModelMock)->setPropertiesFromArr([
                'name' => 'indexName',
                'value' => 'item value'
            ])
        ]), (string)$this->abstractClass);
        $this->assertFalse($this->abstractClass->isEmpty());

        $this->abstractClass->setItems([
            (new AbstractModelMock)->setPropertiesFromArr([
                'name' => 'indexName',
                'value' => 'item value'
            ]),
            (new AbstractModelMock)->setPropertiesFromArr([
                'name' => 'indexName1',
                'value' => 'item value'
            ]),
        ]);
        $this->assertCount(2, $this->abstractClass->getItems());
    }
}
