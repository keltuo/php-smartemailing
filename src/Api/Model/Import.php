<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model;

use JetBrains\PhpStorm\ArrayShape;
use SmartEmailing\Api\Model\Bag\ContactBag;
use SmartEmailing\Api\Model\Contact\Settings;

class Import extends AbstractModel
{
    protected ContactBag $contactBag;
    protected ?Settings $settings;

    public function __construct(ContactBag $contactBag, ?Settings $settings = null)
    {
        $this->setContactBag($contactBag);
        $this->setSettings($settings);
    }

    public function getSettings(): ?Settings
    {
        return $this->settings;
    }

    public function setSettings(?Settings $settings): Import
    {
        $this->settings = $settings;
        return $this;
    }

    public function getContactBag(): ContactBag
    {
        return $this->contactBag;
    }

    public function setContactBag(ContactBag $contactBag): Import
    {
        $this->contactBag = $contactBag;
        return $this;
    }

    #[ArrayShape(
        [
        'settings' => "\SmartEmailing\Api\Model\Settings",
        'data' => "\SmartEmailing\Api\Model\ContactBag",
        ]
    )]
    public function toArray(): array
    {
        return \array_filter(
            [
            'settings' => $this->getSettings(),
            'data' => $this->getContactBag(),
            ],
            static fn ($item) => !\is_null($item)
        );
    }
}
