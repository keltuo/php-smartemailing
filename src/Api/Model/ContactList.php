<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model;


use JetBrains\PhpStorm\ArrayShape;
use SmartEmailing\Util\Helpers;

class ContactList extends AbstractModel
{
    /**
     * Contactlist name that will not be displayed to public 
     */
    protected ?string $name;
    /**
     * Contactlist name that will be displayed to public
     */
    protected ?string $publicName;
    /**
     * Name of contact list owner, will be used in your campaigns 
     */
    protected ?string $senderName;
    /**
     * E-mail address of list owner, will be used in your campaigns 
     */
    protected ?string $senderEmail;
    /**
     * Reply-to e-mail address of list owner, will be used in your campaigns 
     */
    protected ?string $replyTo;

    /**
     * @param string|null $name
     * @param string|null $publicName
     * @param string|null $senderName
     * @param string|null $senderEmail
     * @param string|null $replyTo
     */
    public function __construct(
        ?string $name = null,
        ?string $publicName = null,
        ?string $senderName = null,
        ?string $senderEmail = null,
        ?string $replyTo = null
    ) {
        $this->setName($name);
        $this->setPublicName($publicName);
        $this->setSenderName($senderName);
        $this->setSenderEmail($senderEmail);
        $this->setReplyTo($replyTo);
    }


    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): ContactList
    {
        $this->name = $name;
        return $this;
    }

    public function getPublicName(): ?string
    {
        return $this->publicName;
    }

    public function setPublicName(?string $publicName): ContactList
    {
        $this->publicName = $publicName;
        return $this;
    }

    public function getSenderName(): ?string
    {
        return $this->senderName;
    }

    public function setSenderName(?string $senderName): ContactList
    {
        $this->senderName = $senderName;
        return $this;
    }

    public function getSenderEmail(): ?string
    {
        return $this->senderEmail;
    }

    public function setSenderEmail(?string $senderEmail): ContactList
    {
        if (!is_null($senderEmail)) {
            Helpers::validateEmail($senderEmail);
        }
        $this->senderEmail = $senderEmail;
        return $this;
    }

    public function getReplyTo(): ?string
    {
        return $this->replyTo;
    }

    public function setReplyTo(?string $replyTo): ContactList
    {
        $this->replyTo = $replyTo;
        return $this;
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
        return array_filter(
            [
                'name' => $this->getName(),
                'publicname' => $this->getPublicName(),
                'sendername' => $this->getSenderName(),
                'senderemail' => $this->getSenderEmail(),
                'replyto' => $this->getReplyTo()
            ],
            fn($item) => !is_null($item)
        );
    }
}
