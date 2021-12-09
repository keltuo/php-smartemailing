<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model\Contact;

use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use SmartEmailing\Api\Model\AbstractModel;
use SmartEmailing\Api\Model\ModelInterface;

class CustomField extends AbstractModel implements ModelInterface
{
    protected int $id;

    /**
     * Array of Customfields options IDs matching with selected Custom-field.
     * Required for composite custom-fields
     *
     * @var array
     */
    protected array $options = [];

    /**
     * String value for simple custom-fields, and YYYY-MM-DD HH:MM:SS for date custom-fields.
     * Value size is limited to 64KB. Required for simple custom-fields
     */
    protected string $value = '';

    /**
     * .
     *
     * @param array $options
     */
    public function __construct(int $id, array $options = [], string $value = '')
    {
        $this->setId($id);
        $this->setOptions($options);
        $this->setValue($value);
    }

    #[Pure]
    public function getIdentifier(): string
    {
        return (string)$this->getId();
    }

    public function setId(int $id): CustomField
    {
        $this->id = $id;
        return $this;
    }

    public function setOptions(array $options): CustomField
    {
        $this->options = $options;
        return $this;
    }

    public function addOption(mixed $customFiledId): CustomField
    {
        $this->options[] = \intval($customFiledId);
        return $this;
    }

    public function setValue(string $value): CustomField
    {
        $this->value = $value;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    #[ArrayShape(
        [
        'id' => "int",
        'options' => "array",
        'value' => "string",
        ]
    )]
    public function toArray(): array
    {
        return \array_filter(
            [
            'id' => $this->getId(),
            'options' => $this->getOptions(),
            'value' => $this->getValue(),
            ],
            static fn ($item) => !empty($item)
        );
    }
}
