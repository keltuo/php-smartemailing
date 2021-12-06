<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model;

class Newsletter extends AbstractModel
{
    /**
     * Id of email to send
     */
    protected int $emailId;

    /**
     * Ids of contactlists to send newsletter to.
     */
    protected array $contactListIds = [];

    /**
     * Ids of contactlists to exclude from sending.
     */
    protected array $excludeContactListIds = [];

    /**
     * Internal newsletter name. Email name will be used if left empty.
     */
    protected ?string $name = null;

    /**
     * When should sending start in YYYY-MM-DD 00:00:00 format.
     * Sending will be started immediately if left empty.
     */
    protected ?string $start = null;

    /**
     * Should statistics be measured.
     */
    protected bool $measureStats = true;

    /**
     * Should newsletter be send to contact during the time it most often reads emails.
     */
    protected bool $sendOnPreferredTime = false;

    /**
     * Sender email address.
     * Sender email, name and replyto needs to be set, otherwise contactlist settings will be used.
     * Must be a confirmed email.
     */
    protected ?string $senderEmail = null;

    /**
     * Sender name.
     * Sender email, name and replyto needs to be set, otherwise contactlist settings will be used.
     */
    protected ?string $senderName = null;

    /**
     * Reply to email address.
     * Sender email, name and replyto needs to be set, otherwise contactlist settings will be used.
     * Must be a confirmed email.
     */
    protected ?string $replyTo = null;

    /**
     * GA settings.
     */
    protected ?string $utmSource = null;
    protected ?string $utmMedium = null;
    protected ?string $utmCampaign = null;
    protected ?string $utmContent = null;

    /**
     * @param array $contactListIds
     */
    public function __construct(
        int $emailId,
        array $contactListIds,
    ) {
        $this->setEmailId($emailId);
        $this->setContactListIds($contactListIds);
    }

    public function getEmailId(): int
    {
        return $this->emailId;
    }

    public function setEmailId(int $emailId): Newsletter
    {
        $this->emailId = $emailId;
        return $this;
    }

    public function getContactListIds(): array
    {
        return $this->contactListIds;
    }

    public function setContactListIds(array $contactListIds): Newsletter
    {
        $this->contactListIds = $contactListIds;
        return $this;
    }

    public function getExcludeContactListIds(): array
    {
        return $this->excludeContactListIds;
    }

    public function setExcludeContactListIds(array $excludeContactListIds): Newsletter
    {
        $this->excludeContactListIds = $excludeContactListIds;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): Newsletter
    {
        $this->name = $name;
        return $this;
    }

    public function getStart(): ?string
    {
        return $this->start;
    }

    public function setStart(?string $start): Newsletter
    {
        $this->start = $start;
        return $this;
    }

    public function isMeasureStats(): bool
    {
        return $this->measureStats;
    }

    public function setMeasureStats(bool $measureStats): Newsletter
    {
        $this->measureStats = $measureStats;
        return $this;
    }

    public function isSendOnPreferredTime(): bool
    {
        return $this->sendOnPreferredTime;
    }

    public function setSendOnPreferredTime(bool $sendOnPreferredTime): Newsletter
    {
        $this->sendOnPreferredTime = $sendOnPreferredTime;
        return $this;
    }

    public function getSenderEmail(): ?string
    {
        return $this->senderEmail;
    }

    public function setSenderEmail(?string $senderEmail): Newsletter
    {
        $this->senderEmail = $senderEmail;
        return $this;
    }

    public function getSenderName(): ?string
    {
        return $this->senderName;
    }

    public function setSenderName(?string $senderName): Newsletter
    {
        $this->senderName = $senderName;
        return $this;
    }

    public function getReplyTo(): ?string
    {
        return $this->replyTo;
    }

    public function setReplyTo(?string $replyTo): Newsletter
    {
        $this->replyTo = $replyTo;
        return $this;
    }

    public function getUtmSource(): ?string
    {
        return $this->utmSource;
    }

    public function setUtmSource(?string $utmSource): Newsletter
    {
        $this->utmSource = $utmSource;
        return $this;
    }

    public function getUtmMedium(): ?string
    {
        return $this->utmMedium;
    }

    public function setUtmMedium(?string $utmMedium): Newsletter
    {
        $this->utmMedium = $utmMedium;
        return $this;
    }

    public function getUtmCampaign(): ?string
    {
        return $this->utmCampaign;
    }

    public function setUtmCampaign(?string $utmCampaign): Newsletter
    {
        $this->utmCampaign = $utmCampaign;
        return $this;
    }

    public function getUtmContent(): ?string
    {
        return $this->utmContent;
    }

    public function setUtmContent(?string $utmContent): Newsletter
    {
        $this->utmContent = $utmContent;
        return $this;
    }

    public function toArray(): array
    {
        return \array_filter([
            'email_id' => $this->getEmailId(),
            'contactlists' => $this->getContactListIds(),
            'excluded_contactlists' => $this->getExcludeContactListIds(),
            'name' => $this->getName(),
            'start' => $this->getStart(),
            'measurestats' => $this->isMeasureStats(),
            'sendOnPreferredTime' => $this->isSendOnPreferredTime(),
            'senderemail' => $this->getSenderEmail(),
            'sendername' => $this->getSenderName(),
            'replyto' => $this->getReplyTo(),
            'utm_source' => $this->getUtmSource(),
            'utm_medium' => $this->getUtmMedium(),
            'utm_campaign' => $this->getUtmCampaign(),
            'utm_content' => $this->getUtmContent(),
        ], static fn ($item) => !empty($item));
    }
}
