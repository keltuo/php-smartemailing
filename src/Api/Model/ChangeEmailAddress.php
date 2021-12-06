<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model;

use JetBrains\PhpStorm\ArrayShape;
use SmartEmailing\Util\Helpers;

class ChangeEmailAddress extends AbstractModel
{
    /**
     * Original e-mail address of existing contact 
     */
    protected string $originalEmailAddress;

    /**
     * New e-mail address 
     */
    protected string $newEmailAddress;

    public function __construct(string $originalEmailAddress, string $newEmailAddress)
    {
        $this->setOriginalEmailAddress($originalEmailAddress);
        $this->setNewEmailAddress($newEmailAddress);
    }

    public function getOriginalEmailAddress(): string
    {
        return $this->originalEmailAddress;
    }

    public function setOriginalEmailAddress(string $originalEmailAddress): ChangeEmailAddress
    {
        Helpers::validateEmail($originalEmailAddress);
        $this->originalEmailAddress = $originalEmailAddress;
        return $this;
    }

    public function getNewEmailAddress(): string
    {
        return $this->newEmailAddress;
    }

    public function setNewEmailAddress(string $newEmailAddress): ChangeEmailAddress
    {
        Helpers::validateEmail($newEmailAddress);
        $this->newEmailAddress = $newEmailAddress;
        return $this;
    }


    #[ArrayShape(
        [
        'from' => "string",
        'to' => "string",
        ]
    )]
    public function toArray(): array
    {
        return [
            'from' => $this->getOriginalEmailAddress(),
            'to' => $this->getNewEmailAddress(),
        ];
    }
}
