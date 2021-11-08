<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model\Search;

class NewsletterStats extends AbstractSearch
{
    public const ID = 'id';
    public const EMAIL_ID = 'email_id';
    public const SMS_ID = 'sms_id';
    public const NAME = 'name';
    public const SENT = 'sent';
    public const OPENED = 'opened';
    public const CLICKED = 'clicked';
    public const UNSUBSCRIBE = 'unsubscribed';
    public const BOUNCED = 'bounced';
    public const UNOPENED = 'unopened';
    public const UNOPENED_PERC = 'unopened_perc';
    public const OPENED_PERC = 'opened_perc';
    public const CLICKED_PERC = 'clicked_perc';
    public const CLICKED_PERC_ABS = 'clicked_perc_abs';
    public const UNSUBSCRIBE_PERC = 'unsubscribed_perc';
    public const UNSUBSCRIBE_PERC_ABS = 'unsubscribed_perc_abs';
    public const BOUNCED_PERC = 'bounced_perc';
    public const START = 'start';
    public const FINISH = 'finish';

    protected function getSelectAllowedValues(): array
    {
        return [
            self::ID,
            self::EMAIL_ID,
            self::SMS_ID,
            self::NAME,
            self::SENT,
            self::OPENED,
            self::CLICKED,
            self::UNSUBSCRIBE,
            self::BOUNCED,
            self::UNOPENED,
            self::UNOPENED_PERC,
            self::OPENED_PERC,
            self::CLICKED_PERC,
            self::CLICKED_PERC_ABS,
            self::UNSUBSCRIBE_PERC,
            self::UNSUBSCRIBE_PERC_ABS,
            self::BOUNCED_PERC,
            self::START,
            self::FINISH,
        ];
    }

    protected function getFilterAllowedValues(): array
    {
         return [
             self::ID,
             self::EMAIL_ID,
             self::SMS_ID,
             self::NAME,
         ];
    }
}
