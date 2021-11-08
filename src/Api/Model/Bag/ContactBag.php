<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model\Bag;

use SmartEmailing\Api\Model\Contact\Contact;

class ContactBag extends AbstractBag
{
    public function add(Contact $model): ContactBag
    {
        $this->insertEntry($model);
        return $this;
    }

    public function create(
        string $emailAddress
    ): Contact
    {
        $model = (new Contact($emailAddress));
        $this->add($model);
        return $model;
    }
}
