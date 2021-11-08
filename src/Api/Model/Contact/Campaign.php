<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model\Contact;

use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use SmartEmailing\Api\Model\AbstractModel;
use SmartEmailing\Api\Model\Bag\ReplaceBag;

class Campaign extends AbstractModel
{
    /**
     * ID of E-mail containing {{confirmlink}}.
     */
    protected int $emailId;

    protected SenderCredentials $senderCredentials;
    /**
     * URL of thank-you page where contact will be redirected after clicking at confirmation link.
     * Link can be customized by contact fields e.g. https://example.com/?name={{ df_name }}.
     * If not provided, contact will be redirected to default page [https://app.smartemailing.cz/public/confirmation-complete/].
     */
    protected ?string $confirmationThankYouPageUrl = null;

    protected ?string $validTo = null;

    protected ReplaceBag $replaceBag;

    /**
     * @param int               $emailId
     * @param SenderCredentials $senderCredentials
     */
    public function __construct(int $emailId, SenderCredentials $senderCredentials)
    {
        $this->setEmailId($emailId);
        $this->setSenderCredentials($senderCredentials);
        $this->setReplaceBag(new ReplaceBag());
    }


    public function getEmailId(): int
    {
        return $this->emailId;
    }

    public function setEmailId(int $emailId): Campaign
    {
        $this->emailId = $emailId;
        return $this;
    }

    public function getSenderCredentials(): SenderCredentials
    {
        return $this->senderCredentials;
    }

    public function setSenderCredentials(SenderCredentials $senderCredentials): Campaign
    {
        $this->senderCredentials = $senderCredentials;
        return $this;
    }

    public function getConfirmationThankYouPageUrl(): ?string
    {
        return $this->confirmationThankYouPageUrl;
    }

    public function setConfirmationThankYouPageUrl(?string $confirmationThankYouPageUrl): Campaign
    {
        $this->confirmationThankYouPageUrl = $confirmationThankYouPageUrl;
        return $this;
    }

    public function getValidTo(): ?string
    {
        return $this->validTo;
    }

    public function setValidTo(?string $validTo): Campaign
    {
        $this->validTo = $validTo;
        return $this;
    }

    public function getReplaceBag(): ReplaceBag
    {
        return $this->replaceBag;
    }

    public function setReplaceBag(ReplaceBag $replaceBag): Campaign
    {
        $this->replaceBag = $replaceBag;
        return $this;
    }

    #[ArrayShape(
        [
        'email_id' => "int",
        'sender_credentials' => "\SmartEmailing\Api\Model\Contact\SenderCredentials",
        'confirmation_thank_you_page_url' => "null|string",
        'valid_to' => "null|string",
        'replace' => "\SmartEmailing\Api\Model\Bag\ReplaceBag"
        ]
    )]
    public function toArray(): array
    {
        return array_filter(
            [
            'email_id' => $this->getEmailId(),
            'sender_credentials' => $this->getSenderCredentials(),
            'confirmation_thank_you_page_url' => $this->getConfirmationThankYouPageUrl(),
            'valid_to' => $this->getValidTo(),
            'replace' => $this->getReplaceBag()
            ], fn ($item) => !is_null($item)
        );
    }
}
