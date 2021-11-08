<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model;


use JetBrains\PhpStorm\ArrayShape;
use SmartEmailing\Exception\RequiredFieldException;

class NewContactList extends ContactList
{
    /**
     * @param string      $name
     * @param string      $senderName
     * @param string      $senderEmail
     * @param string      $replyTo
     * @param string|null $publicName
     */
    public function __construct(
        string $name,
        string $senderName,
        string $senderEmail,
        string $replyTo,
        ?string $publicName = null
    ) {
        parent::__construct(
            $name,
            $publicName,
            $senderName,
            $senderEmail,
            $replyTo
        );
    }

    #[ArrayShape(
        [
        'name' => "string",
        'publicname' => "null|string",
        'sendername' => "string",
        'senderemail' => "string",
        'replyto' => "string"
        ]
    )]
    public function toArray(): array
    {
        $data = array_filter(
            [
                'name' => $this->getName(),
                'publicname' => $this->getPublicName(),
                'sendername' => $this->getSenderName(),
                'senderemail' => $this->getSenderEmail(),
                'replyto' => $this->getReplyTo()
            ],
            fn($item) => !is_null($item)
        );
        RequiredFieldException::check(
            [
                'name',
                'sendername',
                'senderemail',
                'replyto'
            ],
            $data
        );
        return $data;
    }
}
