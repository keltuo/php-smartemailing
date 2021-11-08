<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model\Search;

class SingleCustomFieldOptions extends AbstractSearch
{
    public const ID = 'id';
    public const NAME = 'name';
    public const ORDER = 'order';
    public const CUSTOM_FIELD_ID = 'customfield_id';

    protected function getSelectAllowedValues(): array
    {
        return [
            self::ID,
            self::NAME,
            self::ORDER,
            self::CUSTOM_FIELD_ID,
        ];
    }
}
