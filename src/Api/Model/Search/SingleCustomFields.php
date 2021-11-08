<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model\Search;

class SingleCustomFields extends AbstractSearch
{
    public const ID = 'id';
    public const NAME = 'name';
    public const TYPE = 'type';
    public const CUSTOM_FIELD_OPTIONS = 'customfield_options';

    protected function getSelectAllowedValues(): array
    {
        return [
            self::ID,
            self::NAME,
            self::TYPE,
        ];
    }
}
