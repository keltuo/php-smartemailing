<?php
declare(strict_types=1);

namespace SmartEmailing\Test\Unit\Api\Model\Search;

use PHPUnit\Framework\TestCase;
use SmartEmailing\Api\Model\Search\AbstractSearch;
use SmartEmailing\Exception\AllowedTypeException;
use SmartEmailing\Test\Mock\AbstractSearchMock;

class AbstractSearchTest extends TestCase
{
    protected AbstractSearchMock $abstractClass;

    public function setUp(): void
    {
        parent::setUp();
        $this->abstractClass = $this->getMockForAbstractClass(AbstractSearchMock::class);
    }

    public function testFilterByShouldThrowException()
    {
        $this->expectException(AllowedTypeException::class);
        $this->expectExceptionMessage('This type [key] is not allowed. Supported types []');
        $abstractSearch = $this->getMockForAbstractClass(AbstractSearch::class);
        $abstractSearch->filterBy('key', 'value');
    }

    public function testSelectByShouldThrowException()
    {
        $this->expectException(AllowedTypeException::class);
        $this->expectExceptionMessage('This type [key] is not allowed. Supported types []');
        $abstractSearch = $this->getMockForAbstractClass(AbstractSearch::class);
        $abstractSearch->selectBy('key');
    }

    public function testSortByShouldThrowException()
    {
        $this->expectException(AllowedTypeException::class);
        $this->expectExceptionMessage('This type [key] is not allowed. Supported types []');
        $abstractSearch = $this->getMockForAbstractClass(AbstractSearch::class);
        $abstractSearch->sortBy('key', AbstractSearch::SORT_DESC);
    }

    public function testExpandByShouldThrowException()
    {
        $this->expectException(AllowedTypeException::class);
        $this->expectExceptionMessage('This type [key] is not allowed. Supported types []');
        $abstractSearch = $this->getMockForAbstractClass(AbstractSearch::class);
        $abstractSearch->expandBy('key');
    }

    public function testSelectByTypeShouldThrowException()
    {
        $this->expectException(AllowedTypeException::class);
        $this->expectExceptionMessage('This type [key] is not allowed. Supported types []');
        $abstractSearch = $this->getMockForAbstractClass(AbstractSearch::class);
        $abstractSearch->selectByType('key');
    }

    public function testGetFilter()
    {
        $this->assertEquals([], $this->abstractClass->getFilter());

        $this->abstractClass->setFilterAllowedValue(['key']);
        $this->abstractClass->filterBy('key', 'value');
        $this->assertEquals(['key' => 'value'], $this->abstractClass->getFilter());
    }

    public function testGetSort()
    {
        $this->assertEquals([], $this->abstractClass->getSort());

        $this->abstractClass->setSortAllowedValue(['keydesc', 'keyasc']);
        $this->abstractClass->sortBy('keydesc', AbstractSearchMock::SORT_DESC);
        $this->abstractClass->sortBy('keyasc', AbstractSearchMock::SORT_ASC);
        $this->assertEquals(['-keydesc', 'keyasc'], $this->abstractClass->getSort());
    }

    public function testGetSelect()
    {
        $this->assertEquals([], $this->abstractClass->getSelect());

        $this->abstractClass->setSelectAllowedValue(['keydesc', 'keyasc']);
        $this->abstractClass->selectBy('keydesc');
        $this->abstractClass->selectBy('keyasc');
        $this->assertEquals(['keydesc', 'keyasc'], $this->abstractClass->getSelect());
    }

    public function testExpandBy()
    {
        $this->assertEquals([], $this->abstractClass->getExpand());

        $this->abstractClass->setExpandAllowedValue(['customfields']);
        $this->abstractClass->expandBy('customfields');
        $this->assertEquals(['customfields'], $this->abstractClass->getExpand());
    }

    public function testToArray()
    {
        $limitAndOffset = [
            'limit' => $this->abstractClass->getLimit(),
            'offset' => $this->abstractClass->getOffset()
        ];
        $this->assertEquals($limitAndOffset, $this->abstractClass->toArray());
        $this->abstractClass->setExpandAllowedValue(['customfields']);
        $this->abstractClass->expandBy('customfields');

        $this->abstractClass->setActionTypeAllowedValue(['actiontype']);
        $this->abstractClass->selectByType('actiontype');
        $this->assertEquals(array_merge([
            'expand' => ['customfields'],
            'type' => 'actiontype'
        ], $limitAndOffset), $this->abstractClass->toArray());
    }

    public function testSetOffset()
    {
        $this->abstractClass->setOffset(2);
        $this->assertEquals(2, $this->abstractClass->getOffset());
    }

    public function testJsonSerialize()
    {
        $limitAndOffset = [
            'limit' => $this->abstractClass->getLimit(),
            'offset' => $this->abstractClass->getOffset()
        ];
        $this->assertEquals($limitAndOffset, $this->abstractClass->toArray());
        $this->abstractClass->setExpandAllowedValue(['customfields']);
        $this->abstractClass->expandBy('customfields');

        $this->abstractClass->setActionTypeAllowedValue(['actiontype']);
        $this->abstractClass->selectByType('actiontype');
        $this->assertEquals(array_merge([
            'expand' => ['customfields'],
            'type' => 'actiontype'
        ], $limitAndOffset), $this->abstractClass->jsonSerialize());
        $this->assertEquals('{"expand":["customfields"],"type":"actiontype","limit":500,"offset":0}', json_encode($this->abstractClass));

    }

    public function testSetLimit()
    {
        $this->abstractClass->setLimit(200);
        $this->assertEquals(200, $this->abstractClass->getLimit());
    }

    public function test__toString()
    {
        $limitAndOffset = [
            'limit' => $this->abstractClass->getLimit(),
            'offset' => $this->abstractClass->getOffset()
        ];
        $this->assertEquals($limitAndOffset, $this->abstractClass->toArray());
        $this->abstractClass->setExpandAllowedValue(['customfields']);
        $this->abstractClass->expandBy('customfields');

        $this->abstractClass->setActionTypeAllowedValue(['actiontype']);
        $this->abstractClass->selectByType('actiontype');

        $this->assertEquals('{"expand":["customfields"],"type":"actiontype","limit":500,"offset":0}', (string)$this->abstractClass);
    }
}
