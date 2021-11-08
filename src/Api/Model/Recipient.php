<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model;


use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use SmartEmailing\Util\Helpers;

class Recipient extends AbstractModel implements ModelInterface
{

    /**
     * Recipient's e-mail address
     * We need e-mail address asi unique contact identifier. No Contact can exist without it.
     */
    protected string $emailAddress;

    /**
     * @param string $emailAddress
     */
    public function __construct(string $emailAddress)
    {
        $this->setEmailAddress($emailAddress);
    }

    #[Pure]
    public function getIdentifier(): string
    {
        return $this->getEmailAddress();
    }

    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }

    public function setEmailAddress(string $emailAddress): Recipient
    {
        Helpers::validateEmail($emailAddress);
        $this->emailAddress = $emailAddress;
        return $this;
    }

    #[ArrayShape([
        'emailaddress' => "string",
    ])]
    public function toArray(): array
    {
        return [
            'emailaddress' => $this->getEmailAddress(),
        ];
    }
}
