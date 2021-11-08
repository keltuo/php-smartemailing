<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model;


use JetBrains\PhpStorm\ArrayShape;
use SmartEmailing\Exception\AllowedTypeException;

class Webhook extends AbstractModel
{
    public const EVENT_NEW_CONTACT = 'new_contact';
    public const EVENT_DELIVERY_STATUS = 'delivery_status';
    public const EVENT_UPDATED_CONTACT = 'updated_contact';
    public const EVENT_UNSUBSCRIBE_CONTACT = 'unsubscribed_contact';
    public const EVENT_NEWSLETTER_SENDING_STARTED = 'newsletter_sending_started';
    public const EVENT_NEWSLETTER_SENDING_FINISHED = 'newsletter_sending_finished';
    public const EVENT_SENT_EMAIL = 'sent_email';
    public const EVENT_SCORING_RESULT_CHANGED = 'scoring_result_changed';

    /**
     * The URL you want to be called when event is triggered.
     */
    protected string $targetUrl;
    /**
     * An event you want to listen to.
     * Allowed values: "new_contact, delivery_status, updated_contact, unsubscribed_contact,
     * newsletter_sending_started, newsletter_sending_finished, sent_email, scoring_result_changed"
     */
    protected string $event;

    /**
     * @param string $targetUrl
     * @param string $event
     */
    public function __construct(string $targetUrl, string $event)
    {
        $this->setTargetUrl($targetUrl);
        $this->setEvent($event);
    }

    public function getTargetUrl(): string
    {
        return $this->targetUrl;
    }

    public function setTargetUrl(string $targetUrl): Webhook
    {
        $this->targetUrl = $targetUrl;
        return $this;
    }

    public function getEvent(): string
    {
        return $this->event;
    }

    public function setEvent(string $event): Webhook
    {
        AllowedTypeException::check(
            $event,
            [
                self::EVENT_NEW_CONTACT,
                self::EVENT_DELIVERY_STATUS,
                self::EVENT_UPDATED_CONTACT,
                self::EVENT_UNSUBSCRIBE_CONTACT,
                self::EVENT_NEWSLETTER_SENDING_STARTED,
                self::EVENT_NEWSLETTER_SENDING_FINISHED,
                self::EVENT_SENT_EMAIL,
                self::EVENT_SCORING_RESULT_CHANGED,
            ]
        );
        $this->event = $event;
        return $this;
    }

    #[ArrayShape(
        [
        'target_url' => "string",
        'event' => "string"
        ]
    )]
    public function toArray(): array
    {
        return [
            'target_url' => $this->getTargetUrl(),
            'event' => $this->getEvent(),
        ];
    }
}
