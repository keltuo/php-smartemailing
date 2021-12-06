<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model\Search;

use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;
use SmartEmailing\Exception\AllowedTypeException;
use Stringable;
use function Symfony\Component\String\u;

abstract class AbstractSearch implements JsonSerializable, Stringable
{
    public const SORT_ASC = 'asc';
    public const SORT_DESC = 'desc';

    protected const OFFSET = 0;
    protected const MAX_LIMIT = 500;

    protected const TYPE_SELECT = 'select';
    protected const TYPE_FILTER = 'filter';
    protected const TYPE_EXPAND = 'expand';
    protected const TYPE_SORT = 'sort';
    protected const TYPE_ACTION_TYPE = 'type';
    protected const TYPE_LIMIT = 'limit';
    protected const TYPE_OFFSET = 'offset';
    protected const SORT_DESC_INDEX = '-';

    protected array $select = [];
    protected array $filter = [];
    protected array $expand = [];
    protected array $sort = [];
    protected ?string $actionType = '';

    protected int $offset = self::OFFSET;
    protected int $limit = self::MAX_LIMIT;

    public function selectByType(string $type): self
    {
        if ($this->checkAddKey($type, self::TYPE_ACTION_TYPE, [$this->actionType])) {
            $this->actionType = $type;
        }

        return $this;
    }

    public function selectBy(string $key): self
    {
        if ($this->checkAddKey($key, self::TYPE_SELECT, $this->select)) {
            $this->select[] = $key;
        }

        return $this;
    }

    public function sortBy(string $key, string $sort = self::SORT_ASC): self
    {
        if ($this->checkAddKey($key, self::TYPE_SORT, $this->sort)) {
            $this->sort[] = $sort === self::SORT_DESC ? self::SORT_DESC_INDEX . $key : $key;
        }

        return $this;
    }

    public function filterBy(string $key, string $value): self
    {
        if ($this->checkAddKey($key, self::TYPE_FILTER, $this->filter)) {
            $this->filter[$key] = $value;
        }

        return $this;
    }

    public function expandBy(string $key): self
    {
        if ($this->checkAddKey($key, self::TYPE_EXPAND, $this->expand)) {
            $this->expand[] = $key;
        }

        return $this;
    }

    public function getSelect(): array
    {
        return $this->select;
    }

    public function getFilter(): array
    {
        return $this->filter;
    }

    public function getExpand(): array
    {
        return $this->expand;
    }

    public function getSort(): array
    {
        return $this->sort;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function setOffset(int $offset): self
    {
        $this->offset = $offset;
        return $this;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function setLimit(int $limit): self
    {
        $this->limit = $limit;
        return $this;
    }

    #[ArrayShape(
        [
        self::TYPE_SELECT => "array",
        self::TYPE_EXPAND => "array",
        self::TYPE_SORT => "array",
        self::TYPE_ACTION_TYPE => "null|string",
        self::TYPE_LIMIT => "int",
        self::TYPE_OFFSET => "int"]
    )
    ]
    public function toArray(): array
    {
        return \array_filter(
            [
            self::TYPE_SELECT => $this->select,
            self::TYPE_EXPAND => $this->expand,
            self::TYPE_SORT => $this->sort,
            self::TYPE_ACTION_TYPE => $this->actionType,
            self::TYPE_LIMIT => $this->limit,
            self::TYPE_OFFSET => $this->offset,
            ],
            static fn ($item) => (
                (\is_array($item) && \count($item) > 0)
                || (\is_string($item) && ($item !== ''))
                || (!\is_string($item) && !\is_array($item) && !\is_null($item))
            )
        );
    }

    #[ArrayShape(
        [
        self::TYPE_SELECT => 'array',
        self::TYPE_EXPAND => 'array',
        self::TYPE_SORT => 'array',
        self::TYPE_ACTION_TYPE => 'null|string',
        self::TYPE_LIMIT => 'int',
        self::TYPE_OFFSET => 'int']
    )
    ]
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function getAsQuery(): array
    {
        $queryArr = [];

        foreach ($this->toArray() as $type => $data) {
                $queryArr[$type] = match ($type) {
                    self::TYPE_SELECT, self::TYPE_SORT, self::TYPE_EXPAND => \implode(',', $data),
                    default => $data
                };
        }

        return \array_merge($queryArr, $this->filter);
    }

    protected function getAllowedProperties(string $type): array
    {
        return match ($type) {
            self::TYPE_SELECT => $this->getSelectAllowedValues(),
            self::TYPE_FILTER => $this->getFilterAllowedValues(),
            self::TYPE_EXPAND => $this->getExpandAllowedValues(),
            self::TYPE_SORT => $this->getSortAllowedValues(),
            self::TYPE_ACTION_TYPE => $this->getActionTypeAllowedValues(),
            default => throw new AllowedTypeException(\sprintf('This type [%s] is not supported.', $type))
        };
    }

    protected function getSelectAllowedValues(): array
    {
        return [];
    }

    protected function getFilterAllowedValues(): array
    {
        return [];
    }

    protected function getExpandAllowedValues(): array
    {
        return [];
    }

    protected function getSortAllowedValues(): array
    {
        return [];
    }

    protected function getActionTypeAllowedValues(): array
    {
        return [];
    }

    protected function checkAddKey(string $key, string $type, array $listKeys): bool
    {
        $key = u($key)->lower()->toString();
        AllowedTypeException::check($key, $this->getAllowedProperties($type));
        return match ($type) {
            self::TYPE_FILTER => !\array_key_exists($key, $listKeys),
            default => !\in_array($key, $listKeys),
        };
    }

    public function __toString(): string
    {
        return (string)\json_encode($this);
    }
}
