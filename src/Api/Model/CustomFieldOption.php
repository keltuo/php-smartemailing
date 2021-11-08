<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model;


use JetBrains\PhpStorm\ArrayShape;
use SmartEmailing\Exception\AllowedTypeException;
use SmartEmailing\Exception\RequiredFieldException;

class CustomFieldOption extends AbstractModel
{
    /**
     * Parent customfield ID 
     */
    protected int $customFieldId;
    /**
     * Order of option as displayed in web forms and Contact detail. Lower number will be displayed higher in the list.
     */
    protected int $order;
    /**
     * Name of option
     */
    protected string $name;

    /**
     * @param int    $customFieldId
     * @param int    $order
     * @param string $name
     */
    public function __construct(int $customFieldId, int $order, string $name)
    {
        $this->setCustomFieldId($customFieldId);
        $this->setOrder($order);
        $this->setName($name);
    }

    public function getCustomFieldId(): int
    {
        return $this->customFieldId;
    }

    public function setCustomFieldId(int $customFieldId): CustomFieldOption
    {
        $this->customFieldId = $customFieldId;
        return $this;
    }

    public function getOrder(): int
    {
        return $this->order;
    }

    public function setOrder(int $order): CustomFieldOption
    {
        $this->order = $order;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): CustomFieldOption
    {
        $this->name = $name;
        return $this;
    }

    #[ArrayShape(
        [
        'customfield_id' => "int",
        'order' => "int",
        'name' => "string"
        ]
    )]
    public function toArray(): array
    {
        $data = [
            'customfield_id' => $this->getCustomFieldId(),
            'order' => $this->getOrder(),
            'name' => $this->getName(),
        ];
        RequiredFieldException::check(array_keys($data), $data);
        return $data;
    }
}
