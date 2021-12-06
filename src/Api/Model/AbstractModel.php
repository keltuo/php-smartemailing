<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model;

use JsonSerializable;
use ReflectionClass;
use Stringable;
use function Symfony\Component\String\u;

abstract class AbstractModel implements JsonSerializable, Stringable
{
    abstract public function toArray(): array;

    public function setPropertiesFromArr(array $data = [], array $exclude = []): self
    {
        $ref = new ReflectionClass($this);

        foreach ($data as $param => $value) {
            if (\in_array($param, $exclude)) {
                continue;
            }

            $mapProperty = (string)u('set ' . $param)->camel();

            if ($ref->hasMethod($mapProperty)) {
                $this->{$mapProperty}($value);
            }
        }

        return $this;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function __toString(): string
    {
        return (string)\json_encode($this);
    }
}
