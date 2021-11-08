<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model;


use JetBrains\PhpStorm\ArrayShape;
use SmartEmailing\Exception\AllowedTypeException;

class Purpose extends AbstractModel
{
    public const LAWFUL_CONSENT = 'consent';
    public const LAWFUL_CONTRACT = 'contract';
    public const LAWFUL_LEGAL_OBLIGATION = 'legal-obligation';
    public const LAWFUL_LEGITIMATE_INTEREST = 'legitimate-interest';
    public const LAWFUL_VITAL_INTEREST = 'vital-interest';
    public const LAWFUL_PUBLIC_TASK = 'public-task';

    /**
     * Lawful basis bound to purpose
     * Allowed values: "consent", "contract", "legal-obligation", "legitimate-interest", "vital-interest", "public-task"
     */
    protected string $lawfulBasis;
    /**
     *  Internal purpose name. Your contacts will not see it.
     */
    protected string $name;
    /**
     * Purpose duration
     */
    protected Period $duration;
    /**
     * Internal purpose notes. Your contacts will not see it.
     * Default value: null
     */
    protected ?string $notes;

    /**
     * @param string      $lawfulBasis
     * @param string      $name
     * @param Period      $duration
     * @param string|null $notes
     */
    public function __construct(
        string $lawfulBasis,
        string $name,
        Period $duration,
        ?string $notes = null
    ) {
        $this->setLawfulBasis($lawfulBasis);
        $this->setName($name);
        $this->setDuration($duration);
        $this->setNotes($notes);
    }

    public function getLawfulBasis(): string
    {
        return $this->lawfulBasis;
    }

    public function setLawfulBasis(string $lawfulBasis): Purpose
    {
        AllowedTypeException::check(
            $lawfulBasis,
            [
                self::LAWFUL_CONSENT,
                self::LAWFUL_CONTRACT,
                self::LAWFUL_LEGAL_OBLIGATION,
                self::LAWFUL_LEGITIMATE_INTEREST,
                self::LAWFUL_VITAL_INTEREST,
                self::LAWFUL_PUBLIC_TASK
            ]
        );
        $this->lawfulBasis = $lawfulBasis;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Purpose
    {
        $this->name = $name;
        return $this;
    }

    public function getDuration(): Period
    {
        return $this->duration;
    }

    public function setDuration(Period $duration): Purpose
    {
        $this->duration = $duration;
        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): Purpose
    {
        $this->notes = $notes;
        return $this;
    }

    #[ArrayShape(
        [
        'lawful_basis' => "string",
        'name' => "string",
        'duration' => "\SmartEmailing\Api\Model\Period",
        'notes' => "null|string"
        ]
    )]
    public function toArray(): array
    {
        return [
            'lawful_basis' => $this->getLawfulBasis(),
            'name' => $this->getName(),
            'duration' => $this->getDuration(),
            'notes' => $this->getNotes(),
        ];
    }
}
