<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model;

use JetBrains\PhpStorm\ArrayShape;

class RecipientSms extends Recipient
{
    /**
     * Recipient's cellphone number.
     * If you provide different cell phone than is currently assigned to contact, it will be updated to new value.
     * Phone number must start with international country code. (eg +420 XXX XXX XXX)
     * Phone number may contain spaces. They will be automatically removed.
     */
    protected string $cellphone;

    public function __construct(string $emailAddress, string $cellphone)
    {
        $this->setCellphone($cellphone);

        parent::__construct($emailAddress);
    }

    public function getCellphone(): string
    {
        return $this->cellphone;
    }

    public function setCellphone(string $cellphone): Recipient
    {
        $this->cellphone = $cellphone;
        return $this;
    }

    #[ArrayShape(
        [
        'emailaddress' => "string",
        'cellphone' => "string",
        ]
    )]
    public function toArray(): array
    {
        return \array_merge(
            [
            'cellphone' => $this->getCellphone(),
            ], parent::toArray()
        );
    }
}
