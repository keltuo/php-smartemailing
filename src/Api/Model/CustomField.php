<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model;


use JetBrains\PhpStorm\ArrayShape;
use SmartEmailing\Exception\AllowedTypeException;
use SmartEmailing\Exception\RequiredFieldException;

class CustomField extends AbstractModel
{
    public const TEXT = 'text';
    public const TEXTAREA = "textarea";
    public const DATE = "date";
    public const CHECKBOX = "checkbox";
    public const RADIO = "radio";
    public const SELECT = "select";

    /** Customfield name */
    protected string $name;
    /**
     * Customfield type,
     * Allowed values: "text", "textarea", "date", "checkbox", "radio", "select"
     */
    protected string $type;

    /**
     * @param string $name
     * @param string $type
     */
    public function __construct(string $name, string $type)
    {
        $this->setName($name);
        $this->setType($type);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): CustomField
    {
        $this->name = $name;
        return $this;
    }

    public function getType(): string
    {
        AllowedTypeException::check($this->type, $this->getAllowedTypes());
        return $this->type;
    }

    public function setType(string $type): CustomField
    {
        AllowedTypeException::check($type, $this->getAllowedTypes());
        $this->type = $type;
        return $this;
    }

    public function getAllowedTypes(): array
    {
        return [
            self::TEXT,
            self::TEXTAREA,
            self::DATE,
            self::CHECKBOX,
            self::RADIO,
            self::SELECT
        ];
    }

    #[ArrayShape([
        'name' => "string",
        'type' => "string"
    ])]
    public function toArray(): array
    {
        $data = [
            'name' => $this->getName(),
            'type' => $this->getType(),
        ];
        RequiredFieldException::check(array_keys($data), $data);
        return $data;
    }
}
