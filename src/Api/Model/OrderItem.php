<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model;


use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use SmartEmailing\Api\Model\Bag\AbstractBag;
use SmartEmailing\Api\Model\Bag\AttributeBag;

class OrderItem extends AbstractModel implements ModelInterface
{
    protected string $id;
    protected string $name;
    protected ?string $description;
    protected Price $price;
    protected int $quantity = 0;
    protected string $url;
    protected ?string $imageUrl = null;
    protected AttributeBag $attributeBag;

    /**
     * @param string $id
     * @param string $name
     * @param Price  $price
     * @param int    $quantity
     * @param string $url
     */
    public function __construct(
        string $id,
        string $name,
        Price $price,
        int $quantity,
        string $url
    ) {
        $this->setId($id);
        $this->setName($name);
        $this->setPrice($price);
        $this->setQuantity($quantity);
        $this->setUrl($url);
        $this->attributeBag = new AttributeBag();
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

    public function setId(string $id): OrderItem
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): OrderItem
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): OrderItem
    {
        $this->description = $description;
        return $this;
    }

    public function getPrice(): Price
    {
        return $this->price;
    }

    public function setPrice(Price $price): OrderItem
    {
        $this->price = $price;
        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): OrderItem
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): OrderItem
    {
        $this->url = $url;
        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(?string $imageUrl): OrderItem
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }

    public function getAttributeBag(): AttributeBag
    {
        return $this->attributeBag;
    }

    public function setAttributeBag(AttributeBag $attributeBag): OrderItem
    {
        $this->attributeBag = $attributeBag;
        return $this;
    }

    #[ArrayShape(
        [
        'id' => "string",
        'name' => "string",
        'description' => "null|string",
        'price' => "\SmartEmailing\Api\Model\Price",
        'quantity' => "int",
        'url' => "string",
        'image_url' => "string",
        'attributes' => "\SmartEmailing\Api\Model\Bag\AttributesBag"
        ]
    )]
    public function toArray(): array
    {
        return array_filter(
            [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'price' => $this->getPrice(),
            'quantity' => $this->getQuantity(),
            'url' => $this->getUrl(),
            'image_url' => $this->getImageUrl(),
            'attributes' => $this->getAttributeBag(),
            ], fn ($item) => (
            (!is_object($item) && !empty($item))
            || (is_object($item) && is_a($item, AbstractBag::class) && !$item->isEmpty())
            || (is_object($item) && is_a($item, Price::class))
            )
        );
    }
}
