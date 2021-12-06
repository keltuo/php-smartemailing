<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model;

use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use SmartEmailing\Api\Model\Bag\AbstractBag;
use SmartEmailing\Api\Model\Bag\AttributeBag;
use SmartEmailing\Api\Model\Bag\FeedItemBag;
use SmartEmailing\Api\Model\Bag\OrderItemBag;
use SmartEmailing\Exception\AllowedTypeException;
use SmartEmailing\Util\Helpers;

class Order extends AbstractModel implements ModelInterface
{
    public const STATUS_PLACED = 'placed';
    public const STATUS_PROCESSING = 'processing';
    public const STATUS_SHIPPED = 'shipped';
    public const STATUS_CANCELED = 'canceled';
    public const STATUS_UNKNOWN = 'unknown';

    /**
     * E-mail address of imported order.
     * This is the only required field.
     */
    protected string $emailAddress;

    protected string $eshopName;

    protected string $eshopCode;

    /**
     * Format YYYY-MM-DD HH:MM:SS
     */
    protected ?string $createdAt = null;

    /**
     * Format YYYY-MM-DD HH:MM:SS
     */
    protected ?string $paidAt = null;

    /**
     * Status of order (defaults to placed when not specified).
     * Available values are placed, processing, shipped, cancelled, unknown.
     */
    protected ?string $status = null;

    protected AttributeBag $attributeBag;

    protected OrderItemBag $orderItemBag;

    protected FeedItemBag $feedItemBag;

    public function __construct(
        string $emailAddress,
        string $eshopName,
        string $eshopCode,
    ) {
        $this->setEmailAddress($emailAddress);
        $this->setEshopName($eshopName);
        $this->setEshopCode($eshopCode);
        $this->setAttributeBag(new AttributeBag());
        $this->setOrderItemBag(new OrderItemBag());
        $this->setFeedItemBag(new FeedItemBag());
    }

    #[Pure]
    public function getIdentifier(): string
    {
        return $this->getEshopCode();
    }

    public function setEmailAddress(string $emailAddress): Order
    {
        Helpers::validateEmail($emailAddress);
        $this->emailAddress = $emailAddress;
        return $this;
    }

    public function setEshopName(string $eshopName): Order
    {
        $this->eshopName = $eshopName;
        return $this;
    }

    public function setEshopCode(string $eshopCode): Order
    {
        $this->eshopCode = $eshopCode;
        return $this;
    }

    public function setAttributeBag(AttributeBag $attributeBag): Order
    {
        $this->attributeBag = $attributeBag;
        return $this;
    }

    public function setOrderItemBag(OrderItemBag $orderItemBag): Order
    {
        $this->orderItemBag = $orderItemBag;
        return $this;
    }

    public function setFeedItemBag(FeedItemBag $feedItemBag): Order
    {
        $this->feedItemBag = $feedItemBag;
        return $this;
    }

    public function setCreatedAt(string $createdAt): Order
    {
        $this->createdAt = Helpers::formatDate($createdAt);
        return $this;
    }

    public function setPaidAt(string $paidAt): Order
    {
        $this->paidAt = Helpers::formatDate($paidAt);
        return $this;
    }

    public function setStatus(string $status): Order
    {
        AllowedTypeException::check(
            $status, [
            self::STATUS_PLACED,
            self::STATUS_CANCELED,
            self::STATUS_PROCESSING,
            self::STATUS_SHIPPED,
            self::STATUS_UNKNOWN,
            ]
        );
        $this->status = $status;
        return $this;
    }

    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }

    public function getEshopName(): string
    {
        return $this->eshopName;
    }

    public function getEshopCode(): string
    {
        return $this->eshopCode;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function getPaidAt(): ?string
    {
        return $this->paidAt;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getAttributeBag(): AttributeBag
    {
        return $this->attributeBag;
    }

    public function getOrderItemBag(): OrderItemBag
    {
        return $this->orderItemBag;
    }

    public function getFeedItemBag(): FeedItemBag
    {
        return $this->feedItemBag;
    }

    #[ArrayShape(
        [
        'emailaddress' => "string",
        'eshop_name' => "string",
        'eshop_code' => "string",
        'status' => "string",
        'paid_at' => "null|string",
        'created_at' => "null|string",
        'attributes' => "mixed",
        'items' => "mixed",
        'item_feeds' => "mixed",
        ]
    )] public function toArray(): array
    {
        return \array_filter(
            [
            'emailaddress' => $this->getEmailAddress(),
            'eshop_name' => $this->getEshopName(),
            'eshop_code' => $this->getEshopCode(),
            'status' => $this->getStatus(),
            'paid_at' => $this->getPaidAt(),
            'created_at' => $this->getCreatedAt(),
            'attributes' => $this->getAttributeBag(),
            'items' => $this->getOrderItemBag(),
            'item_feeds' => $this->getFeedItemBag(),
            ], static fn ($item) => (
            (!\is_object($item) && !empty($item))
            || (\is_object($item) && \is_a($item, AbstractBag::class) && !$item->isEmpty())
            )
        );
    }
}
