<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model\Search;

class SingleContact extends AbstractSearch
{
    public const ID = 'id';
    public const LANGUAGE = 'language';
    public const BLACKLISTED = 'blacklisted';
    public const EMAIL_ADDRESS = 'emailaddress';
    public const NAME = 'name';
    public const SURNAME = 'surname';
    public const TITLES_BEFORE = 'titlesbefore';
    public const TITLES_AFTER = 'titlesafter';
    public const BIRTHDAY = 'birthday';
    public const NAME_DAY = 'nameday';
    public const POSTAL_CODE = 'postalcode';
    public const NOTES = 'notes';
    public const PHONE = 'phone';
    public const CELLPHONE = 'cellphone';
    public const REAL_NAME = 'realname';
    public const CUSTOM_FIELDS = 'customfields';

    protected function getSelectAllowedValues(): array
    {
        return [
            self::ID,
            self::LANGUAGE,
            self::BLACKLISTED,
            self::EMAIL_ADDRESS,
            self::NAME,
            self::SURNAME,
            self::TITLES_BEFORE,
            self::TITLES_AFTER,
            self::BIRTHDAY,
            self::NAME_DAY,
            self::POSTAL_CODE,
            self::NOTES,
            self::PHONE,
            self::CELLPHONE,
            self::REAL_NAME,
        ];
    }
}
