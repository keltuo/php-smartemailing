<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model\Bag;

use SmartEmailing\Api\Model\FeedItem;

class FeedItemBag extends AbstractBag
{
    public function add(FeedItem $model): FeedItemBag
    {
        $this->insertEntry($model);
        return $this;
    }

    public function create(
        string $idItem,
        string $feedName,
        int $quantity = 0
    ): FeedItem {
        $model = new FeedItem($idItem, $feedName, $quantity);
        $this->add($model);
        return $model;
    }
}
