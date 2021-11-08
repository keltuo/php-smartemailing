<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model\Bag;

use JetBrains\PhpStorm\Pure;
use JsonSerializable;
use SmartEmailing\Api\Model\ModelInterface;
use Stringable;

abstract class AbstractBag implements JsonSerializable, Stringable
{
    protected array $items = [];
    protected array $idMap = [];

    public function get(int|string $index, mixed $default = null): mixed
    {
        return isset($this->items[$index]) ? $this->items[$index] : $default;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function setItems(array $items): AbstractBag
    {
        foreach ($items as $item) {
            if ($item instanceof ModelInterface) {
                $this->insertEntry($item);
            }
        }
        return $this;
    }

    protected function insertEntry(ModelInterface $entry): bool
    {
        if ($this->checkEntry($entry->getIdentifier())) {
            return false;
        }

        $this->items[] = $entry;
        $this->idMap[$entry->getIdentifier()] = $entry;

        return true;
    }

    protected function checkEntry(string $property): bool
    {
        if (isset($this->idMap[$property])) {
            return true;
        }
        return false;
    }

    public function isEmpty(): bool
    {
        return empty($this->items);
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function __toString(): string
    {
        return (string)json_encode($this);
    }

    public function toArray(): array
    {
        return $this->items;
    }

    #[Pure]
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
