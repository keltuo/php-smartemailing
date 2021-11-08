<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model\Contact;

use JetBrains\PhpStorm\ArrayShape;
use SmartEmailing\Util\Helpers;

class SenderCredentials extends \SmartEmailing\Api\Model\SenderCredentials
{
    /**
     * From e-mail address of opt-in campaign 
     */
    protected string $from;

    /**
     * @param string $from
     * @param string $senderName
     * @param string $replyTo
     */
    public function __construct(string $from, string $senderName, string $replyTo)
    {
        $this->setFrom($from);
        parent::__construct($senderName, $replyTo);
    }

    public function getFrom(): string
    {
        return $this->from;
    }

    public function setFrom(string $from): SenderCredentials
    {
        Helpers::validateEmail($from);
        $this->from = $from;
        return $this;
    }

    #[ArrayShape(
        [
        'from' => "string",
        'sender_name' => "string",
        'reply_to' => "string"
        ]
    )]
    public function toArray(): array
    {
        return array_merge(
            [
            'from' => $this->getFrom(),
            ], parent::toArray()
        );
    }
}
