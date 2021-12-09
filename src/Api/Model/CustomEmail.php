<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model;

use JetBrains\PhpStorm\ArrayShape;
use SmartEmailing\Api\Model\Bag\TaskBag;

class CustomEmail extends AbstractModel
{
    /**
     * Sender's credentials for this request
     */
    protected SenderCredentials $senderCredentials;

    /**
     * Tag used for email grouping
     */
    protected string $tag;

    /**
     * Id of E-mail or E-mail template to send.
     * All dynamic fields in E-mail will be customized per contact.
     */
    protected int $emailId;

    protected TaskBag $taskBag;

    public function __construct(
        SenderCredentials $senderCredentials,
        string $tag,
        int $emailId,
        ?TaskBag $taskBag = null,
    ) {
        $this->setSenderCredentials($senderCredentials);
        $this->setTag($tag);
        $this->setEmailId($emailId);
        $this->setTaskBag(\is_null($taskBag) ? new TaskBag() : $taskBag);
    }

    public function getTag(): string
    {
        return $this->tag;
    }

    public function setTag(string $tag): CustomEmail
    {
        $this->tag = $tag;
        return $this;
    }

    public function getTaskBag(): TaskBag
    {
        return $this->taskBag;
    }

    public function setTaskBag(TaskBag $taskBag): CustomEmail
    {
        $this->taskBag = $taskBag;
        return $this;
    }

    public function getSenderCredentials(): SenderCredentials
    {
        return $this->senderCredentials;
    }

    public function setSenderCredentials(SenderCredentials $senderCredentials): CustomEmail
    {
        $this->senderCredentials = $senderCredentials;
        return $this;
    }

    public function getEmailId(): int
    {
        return $this->emailId;
    }

    public function setEmailId(int $emailId): CustomEmail
    {
        $this->emailId = $emailId;
        return $this;
    }


    #[ArrayShape(
        [
        'tag' => "string",
        'email_id' => "int",
        'tasks' => "\SmartEmailing\Api\Bag\TaskBag",
        'sender_credentials' => "\SmartEmailing\Api\Model\SenderCredentials",
        ]
    )]
    public function toArray(): array
    {
        return [
            'tag' => $this->getTag(),
            'email_id' => $this->getEmailId(),
            'tasks' => $this->getTaskBag(),
            'sender_credentials' => $this->getSenderCredentials(),
        ];
    }
}
