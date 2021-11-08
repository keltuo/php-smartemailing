<?php
declare(strict_types=1);

namespace SmartEmailing\Test\Mock;


use SmartEmailing\Api\Model\Search\AbstractSearch;

class AbstractSearchMock extends AbstractSearch
{
    protected array $selectAllowedValue = [];
    protected array $filterAllowedValue = [];
    protected array $sortAllowedValue = [];
    protected array $expandAllowedValue = [];
    protected array $actionTypeAllowedValue = [];

    protected function getSelectAllowedValues(): array
    {
        return $this->selectAllowedValue;
    }

    protected function getFilterAllowedValues(): array
    {
        return $this->filterAllowedValue;
    }

    protected function getSortAllowedValues(): array
    {
        return $this->sortAllowedValue;
    }

    protected function getExpandAllowedValues(): array
    {
        return $this->expandAllowedValue;
    }

    protected function getActionTypeAllowedValues(): array
    {
        return $this->actionTypeAllowedValue;
    }

    public function setActionTypeAllowedValue(array $actionTypeAllowedValue): AbstractSearchMock
    {
        $this->actionTypeAllowedValue = $actionTypeAllowedValue;
        return $this;
    }

    public function setSelectAllowedValue(array $selectAllowedValue): AbstractSearchMock
    {
        $this->selectAllowedValue = $selectAllowedValue;
        return $this;
    }

    public function setSortAllowedValue(array $sortAllowedValue): AbstractSearchMock
    {
        $this->sortAllowedValue = $sortAllowedValue;
        return $this;
    }

    public function setExpandAllowedValue(array $expandAllowedValue): AbstractSearchMock
    {
        $this->expandAllowedValue = $expandAllowedValue;
        return $this;
    }

    public function setFilterAllowedValue(array $filterAllowedValue): AbstractSearchMock
    {
        $this->filterAllowedValue = $filterAllowedValue;
        return $this;
    }
}
