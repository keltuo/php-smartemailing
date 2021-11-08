<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model\Contact;

use JetBrains\PhpStorm\ArrayShape;
use SmartEmailing\Api\Model\AbstractModel;
use SmartEmailing\Exception\AllowedTypeException;

class DoubleOptInSettings extends AbstractModel
{
    public const SEND_MODE_ALL = 'all';
    public const SEND_MODE_NEW_IN_DATABASE = 'new-in-database';

    /** Double-opt-in e-mail settings  */
    protected Campaign $campaign;
    /**
     * By adding silence period you will not send double opt-in e-mail to any emailaddress that
     * recieved any opt-in e-mail in specified period.
     *
     * Note: to prevent double opt-in spam, silence_period is now added to double_opt_in_settings by default
     * (it not already provided) and set to 1 day.
     */
    protected ?SilencePeriod $silencePeriod;

    /**
     * Double-opt in send-to mode.
     * Fill-in all to send double opt-in e-email to every contact in batch, new-in-database
     * to send double opt-in e-email only to contacts that do not exist in the database yet.
     *
     * Allowed values: "all", "new-in-database"
     */
    protected string $sendToMode;

    /**
     * @param Campaign $campaign
     * @param string $sendToMode
     * @param SilencePeriod|null $silencePeriod
     */
    public function __construct(Campaign $campaign, string $sendToMode, ?SilencePeriod $silencePeriod = null,)
    {
        $this->setCampaign($campaign);
        $this->setSilencePeriod($silencePeriod);
        $this->setSendToMode($sendToMode);
    }

    public function getCampaign(): Campaign
    {
        return $this->campaign;
    }

    public function setCampaign(Campaign $campaign): DoubleOptInSettings
    {
        $this->campaign = $campaign;
        return $this;
    }

    public function getSilencePeriod(): ?SilencePeriod
    {
        return $this->silencePeriod;
    }

    public function setSilencePeriod(?SilencePeriod $silencePeriod): DoubleOptInSettings
    {
        $this->silencePeriod = $silencePeriod;
        return $this;
    }

    public function getSendToMode(): string
    {
        return $this->sendToMode;
    }


    public function setSendToMode(string $sendToMode): DoubleOptInSettings
    {
        AllowedTypeException::check($sendToMode, [self::SEND_MODE_ALL, self::SEND_MODE_NEW_IN_DATABASE]);
        $this->sendToMode = $sendToMode;
        return $this;
    }

    #[ArrayShape([
        'campaign' => "\SmartEmailing\Api\Model\Contact\Campaign",
        'silence_period' => "null|\SmartEmailing\Api\Model\Contact\SilencePeriod",
        'send_to_mode' => "string"
    ])] public function toArray(): array
    {
        return [
            'campaign' => $this->getCampaign(),
            'silence_period' => $this->getSilencePeriod(),
            'send_to_mode' => $this->getSendToMode()
        ];
    }

}
