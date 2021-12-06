<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model\Search;

class ContactLists extends AbstractSearch
{
    public const ID = 'id';
    public const NAME = 'name';
    public const CATEGORY = 'category';
    public const PUBLIC_NAME = 'publicname';
    public const SENDER_NAME = 'sendername';
    public const SENDER_EMAIL = 'senderemail';
    public const REPLY_TO = 'replyto';
    public const SIGNATURE = 'signature';
    public const SEGMENT_ID = 'segment_id';

    protected function getSelectAllowedValues(): array
    {
        return [
            self::ID,
            self::NAME,
            self::CATEGORY,
            self::PUBLIC_NAME,
            self::SENDER_NAME,
            self::SENDER_EMAIL,
            self::REPLY_TO,
            self::SIGNATURE,
            self::SEGMENT_ID,
        ];
    }
}
