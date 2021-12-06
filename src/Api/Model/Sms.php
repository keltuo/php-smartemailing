<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model;

use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use SmartEmailing\Api\Model\Bag\TaskBag;

class Sms extends AbstractModel implements ModelInterface
{
    /**
     * Tag used for SMS grouping
     */
    protected string $tag;

    /**
     * Id of SMS to send.
     * All dynamic fields in SMS will be customized per contact.
     * In addition you can add custom dynamic tags prefixed by replace_ to customize your SMS.
     * Maximum length of SMS is limited to 160 7-bit characters (SMS without diacritics),
     * or 70 16-bit characters (SMS with diacritics). Longer SMS will be divided into chunks.
     * Every chunk is billed as single SMS.
     */
    protected int $smsId;

    protected TaskBag $taskBag;

    public function __construct(string $tag, int $smsId, ?TaskBag $taskBag = null)
    {
        $this->setTag($tag);
        $this->setSmsId($smsId);
        $this->setTaskBag(\is_null($taskBag) ? new TaskBag() : $taskBag);
    }

    #[Pure]
    public function getIdentifier(): string
    {
        return $this->getTag();
    }

    public function getTag(): string
    {
        return $this->tag;
    }

    public function setTag(string $tag): Sms
    {
        $this->tag = $tag;
        return $this;
    }

    public function getSmsId(): int
    {
        return $this->smsId;
    }

    public function setSmsId(int $smsId): Sms
    {
        $this->smsId = $smsId;
        return $this;
    }

    public function getTaskBag(): TaskBag
    {
        return $this->taskBag;
    }

    public function setTaskBag(TaskBag $taskBag): Sms
    {
        $this->taskBag = $taskBag;
        return $this;
    }

    #[ArrayShape(
        [
        'tag' => "string",
        'sms_id' => "int",
        'tasks' => "\SmartEmailing\Api\Model\Bag\TaskBag",
        ]
    )]
    public function toArray(): array
    {
        return [
            'tag' => $this->getTag(),
            'sms_id' => $this->getSmsId(),
            'tasks' => $this->getTaskBag(),
        ];
    }
}
