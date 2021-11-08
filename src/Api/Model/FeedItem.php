<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model;


use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

class FeedItem extends AbstractModel implements ModelInterface
{
    protected string $id;
    protected string $feedName;
    protected int $quantity = 0;

    /**
     * @param string $id
     * @param string $feedName
     * @param int    $quantity
     */
    public function __construct(string $id, string $feedName, int $quantity = 0)
    {
        $this->setId($id);
        $this->setFeedName($feedName);
        $this->setQuantity($quantity);
    }

    #[Pure]
    public function getIdentifier(): string
    {
        return $this->getId();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): FeedItem
    {
        $this->id = $id;
        return $this;
    }

    public function getFeedName(): string
    {
        return $this->feedName;
    }

    public function setFeedName(string $feedName): FeedItem
    {
        $this->feedName = $feedName;
        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): FeedItem
    {
        $this->quantity = $quantity;
        return $this;
    }

    #[ArrayShape(
        [
        'item_id' => "string",
        'feed_name' => "string",
        'quantity' => "int"
        ]
    )]
    public function toArray(): array
    {
        return [
            'item_id' => $this->getId(),
            'feed_name' => $this->getFeedName(),
            'quantity' => $this->getQuantity(),
        ];
    }
}
