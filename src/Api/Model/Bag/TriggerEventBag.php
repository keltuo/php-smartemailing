<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model\Bag;

use SmartEmailing\Api\Model\Event;

class TriggerEventBag extends AbstractBag
{
    public function add(Event $model): TriggerEventBag
    {
        $this->insertEntry($model);
        return $this;
    }

    public function create(
        string $emailAddress,
        string $name,
        array $payload = [],
    ): Event {
        $model = new Event($emailAddress, $name, $payload);
        $this->add($model);
        return $model;
    }
}
