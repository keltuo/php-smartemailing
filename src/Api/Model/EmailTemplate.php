<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model;

use JetBrains\PhpStorm\ArrayShape;
use SmartEmailing\Api\Model\Bag\ReplaceBag;

class EmailTemplate extends AbstractModel
{
    /**
     * E-mail or E-mail template ID 
     */
    protected int $emailId;
    /**
     * Dynamic contents to be replaced 
     */
    protected ReplaceBag $replaceBag;

    /**
     * @param int             $emailId
     * @param ReplaceBag|null $replaceBag
     */
    public function __construct(int $emailId, ?ReplaceBag $replaceBag = null)
    {
        $this->setEmailId($emailId);
        $this->setReplaceBag(is_null($replaceBag) ? new ReplaceBag() : $replaceBag);
    }

    public function getEmailId(): int
    {
        return $this->emailId;
    }

    public function setEmailId(int $emailId): EmailTemplate
    {
        $this->emailId = $emailId;
        return $this;
    }

    public function getReplaceBag(): ReplaceBag
    {
        return $this->replaceBag;
    }

    public function setReplaceBag(ReplaceBag $replaceBag): EmailTemplate
    {
        $this->replaceBag = $replaceBag;
        return $this;
    }

    #[ArrayShape(
        [
        'email_id' => "int",
        'replace' => "\SmartEmailing\Api\Model\Bag\ReplaceBag"
        ]
    )]
    public function toArray(): array
    {
        return [
            'email_id' => $this->getEmailId(),
            'replace' => $this->getReplaceBag(),
        ];
    }
}
