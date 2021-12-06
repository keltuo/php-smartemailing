<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model;

use JetBrains\PhpStorm\ArrayShape;
use SmartEmailing\Exception\AllowedTypeException;

class Period extends AbstractModel
{
    public const SECONDS = 'seconds';
    public const MINUTES = 'minutes';
    public const HOURS = 'hours';
    public const DAYS = 'days';
    public const WEEKS = 'weeks';
    public const MONTHS = 'months';
    public const YEARS = 'years';

    /**
     * Period unit
     * Allowed values: see getAllowedUnits()
     */
    protected string $unit;

    /**
     * Period value, must be integer 
     */
    protected int $value;

    public function __construct(string $unit, int $value)
    {
        $this->setUnit($unit);
        $this->setValue($value);
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): Period
    {
        AllowedTypeException::check($unit, $this->getAllowedUnits());
        $this->unit = $unit;
        return $this;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function setValue(int $value): Period
    {
        $this->value = $value;
        return $this;
    }

    #[ArrayShape(
        [
        'unit' => "string",
        'value' => "int",
        ]
    )]
    public function toArray(): array
    {
        return [
            'unit' => $this->getUnit(),
            'value' => $this->getValue(),
        ];
    }

    protected function getAllowedUnits(): array
    {
        return [
            self::DAYS,
            self::MONTHS,
            self::YEARS,
        ];
    }
}
