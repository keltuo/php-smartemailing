<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model\Search;

class PurposeConnections extends AbstractSearch
{
    public const ID = 'id';
    public const CREATED_AT = 'created_at';
    public const CONTACT_ID = 'contact_id';
    public const VALID_FROM = 'valid_from';
    public const VALID_TO = 'valid_to';
    public const PURPOSE_ID = 'purpose_id';
    public const DETAILS = 'details';

    protected function getDefaultFields(): array
    {
        return [
            self::ID,
            self::CREATED_AT,
            self::CONTACT_ID,
            self::VALID_FROM,
            self::VALID_TO,
            self::PURPOSE_ID,
            self::DETAILS,
        ];
    }

    protected function getSelectAllowedValues(): array
    {
        return $this->getDefaultFields();
    }

    protected function getFilterAllowedValues(): array
    {
        return $this->getDefaultFields();
    }

    protected function getSortAllowedValues(): array
    {
        return [
            self::ID,
            self::CREATED_AT,
            self::CONTACT_ID,
            self::VALID_FROM,
            self::VALID_TO,
            self::PURPOSE_ID,
        ];
    }
}
