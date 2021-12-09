<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model;

use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use SmartEmailing\Util\Helpers;

class Event extends AbstractModel implements ModelInterface
{
    /**
     * Email address to trigger the event for, will be created if necessary.
     */
    protected string $emailAddress;

    /**
     * Name of the event. All event nodes that listen for this event name will get triggered.
     */
    protected string $name;

    /**
     * Event payload. This payload is available throughout the entire contact's walkthrough.
     */
    protected array $payload = [];

    /**
     * @param array $payload
     */
    public function __construct(string $emailAddress, string $name, array $payload)
    {
        $this->setEmailAddress($emailAddress);
        $this->setName($name);
        $this->setPayload($payload);
    }

    #[Pure]
    public function getIdentifier(): string
    {
        return $this->getName();
    }

    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }

    public function setEmailAddress(string $emailAddress): Event
    {
        Helpers::validateEmail($emailAddress);
        $this->emailAddress = $emailAddress;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Event
    {
        $this->name = $name;
        return $this;
    }

    public function getPayload(): array
    {
        return $this->payload;
    }

    public function setPayload(array $payload): Event
    {
        $this->payload = $payload;
        return $this;
    }

    #[ArrayShape(
        [
        'emailaddress' => "string",
        'name' => "string",
        'payload' => "array",
        ]
    )]
    public function toArray(): array
    {
        return [
            'emailaddress' => $this->getEmailAddress(),
            'name' => $this->getName(),
            'payload' => $this->getPayload(),
        ];
    }
}
