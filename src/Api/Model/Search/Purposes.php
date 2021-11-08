<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model\Search;

class Purposes extends AbstractSearch
{
    public const ID = 'id';
    public const CREATED_AT = 'created_at';
    public const LAWFUL_BASIS = 'lawful_basis';
    public const NAME = 'name';
    public const DURATION = 'duration';
    public const NOTES = 'notes';

    protected function getSelectAllowedValues(): array
    {
        return [
            self::ID,
            self::CREATED_AT,
            self::LAWFUL_BASIS,
            self::NAME,
            self::DURATION,
            self::NOTES,
        ];
    }

    protected function getSortAllowedValues(): array
    {
        return [
            self::ID,
            self::CREATED_AT,
            self::LAWFUL_BASIS,
            self::NAME,
            self::NOTES,
        ];
    }
}
