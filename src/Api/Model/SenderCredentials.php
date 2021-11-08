<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model;

use JetBrains\PhpStorm\ArrayShape;
use SmartEmailing\Util\Helpers;

class SenderCredentials extends AbstractModel
{
    /**
     * Contact:  From name of opt-in campaign
     * Email: Sender's name as displayed in From header
     */
    protected string $senderName;
    /**
     * Contact: Reply-To e-mail address in opt-in campaign
     * Email: E-mail address displayed in Reply-To header
     */
    protected string $replyTo;

    /**
     * @param string $senderName
     * @param string $replyTo
     */
    public function __construct(string $senderName, string $replyTo)
    {
        $this->setSenderName($senderName);
        $this->setReplyTo($replyTo);
    }

    public function getSenderName(): string
    {
        return $this->senderName;
    }

    public function setSenderName(string $senderName): SenderCredentials
    {
        $this->senderName = $senderName;
        return $this;
    }

    public function getReplyTo(): string
    {
        return $this->replyTo;
    }

    public function setReplyTo(string $replyTo): SenderCredentials
    {
        Helpers::validateEmail($replyTo);
        $this->replyTo = $replyTo;
        return $this;
    }

    #[ArrayShape(
        [
        'sender_name' => "string",
        'reply_to' => "string"
        ]
    )]
    public function toArray(): array
    {
        return [
            'sender_name' => $this->getSenderName(),
            'reply_to' => $this->getReplyTo()
        ];
    }
}
