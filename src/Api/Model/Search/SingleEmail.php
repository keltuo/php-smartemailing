<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model\Search;

class SingleEmail extends AbstractSearch
{
    public const ID = 'id';
    public const NAME = 'name';
    public const TITLE = 'surname';
    public const HTML_BODY = 'htmlbody';
    public const TEXT_BODY = 'textbody';
    public const CREATED = 'created';

    protected function getDefaultFields(): array
    {
        return [
            self::ID,
            self::NAME,
            self::TITLE,
            self::HTML_BODY,
            self::TEXT_BODY,
            self::CREATED,
        ];
    }

    protected function getSelectAllowedValues(): array
    {
        return $this->getDefaultFields();
    }
}
