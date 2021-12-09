<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model\Contact;

use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use SmartEmailing\Api\Model\AbstractModel;
use SmartEmailing\Api\Model\ModelInterface;
use SmartEmailing\Util\Helpers;

class Purpose extends AbstractModel implements ModelInterface
{
    protected int $id;

    /**
     * Date and time since processing purpose is valid in YYYY-MM-DD HH:MM:SS format. If empty, current date
     * and time will be used.
     * Default value: null
     */
    protected ?string $validFrom;

    /**
     * Date and time of processing purpose validity end in YYYY-MM-DD HH:MM:SS format. If empty, it will be
     * calculated as valid_from + default duration of particular purpose.
     * Default value: null
     */
    protected ?string $validTo;

    public function __construct(int $id, ?string $validFrom = null, ?string $validTo = null)
    {
        $this->id = $id;
        $this->setValidFrom($validFrom);
        $this->setValidTo($validTo);
    }

    #[Pure]
    public function getIdentifier(): string
    {
        return (string)$this->getId();
    }

    public function setId(mixed $id): Purpose
    {
        $this->id = \intval($id);
        return $this;
    }

    /**
     * Date and time since processing purpose is valid. Allowed format: YYYY-MM-DD HH:MM:SS.
     */
    public function setValidFrom(?string $validFrom): Purpose
    {

        $this->validFrom = \is_null($validFrom) ? null : Helpers::formatDate($validFrom);
        return $this;
    }

    /**
     * Date and time of processing purpose validity end. Allowed format: YYYY-MM-DD HH:MM:SS.
     */
    public function setValidTo(?string $validTo): Purpose
    {
        $this->validTo = \is_null($validTo) ? null : Helpers::formatDate($validTo);
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getValidFrom(): ?string
    {
        return $this->validFrom;
    }

    public function getValidTo(): ?string
    {
        return $this->validTo;
    }

    #[ArrayShape(
        [
        'id' => "int",
        'valid_from' => "null|string",
        'valid_to' => "null|string",
        ]
    )]
    public function toArray(): array
    {
        return \array_filter(
            [
            'id' => $this->getId(),
            'valid_from' => $this->getValidFrom(),
            'valid_to' => $this->getValidTo(),
            ],
            static fn ($item) => !\is_null($item)
        );
    }
}
