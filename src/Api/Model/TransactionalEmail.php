<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model;

use SmartEmailing\Api\Model\Bag\TaskBag;

class TransactionalEmail extends AbstractModel
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
     * Either email_id or message_contents is required. When both are specified, email_id takes preference.
     */
    protected ?int $emailId = null;

    /**
     * Contents of the message
     * Either email_id or message_contents is required. When both are specified, email_id takes preference.
     */
    protected ?MessageContent $messageContent = null;

    protected TaskBag $taskBag;

    public function __construct(
        SenderCredentials $senderCredentials,
        string $tag,
        ?TaskBag $taskBag = null,
    ) {
        $this->setSenderCredentials($senderCredentials);
        $this->setTag($tag);
        $this->setTaskBag(\is_null($taskBag) ? new TaskBag() : $taskBag);
    }

    public function getMessageContent(): ?MessageContent
    {
        return $this->messageContent;
    }

    public function setMessageContent(?MessageContent $messageContent): TransactionalEmail
    {
        $this->messageContent = $messageContent;
        return $this;
    }

    public function getTag(): string
    {
        return $this->tag;
    }

    public function setTag(string $tag): TransactionalEmail
    {
        $this->tag = $tag;
        return $this;
    }

    public function getTaskBag(): TaskBag
    {
        return $this->taskBag;
    }

    public function setTaskBag(TaskBag $taskBag): TransactionalEmail
    {
        $this->taskBag = $taskBag;
        return $this;
    }

    public function getSenderCredentials(): SenderCredentials
    {
        return $this->senderCredentials;
    }

    public function setSenderCredentials(SenderCredentials $senderCredentials): TransactionalEmail
    {
        $this->senderCredentials = $senderCredentials;
        return $this;
    }

    public function getEmailId(): ?int
    {
        return $this->emailId;
    }

    public function setEmailId(int $emailId): TransactionalEmail
    {
        $this->emailId = $emailId;
        return $this;
    }

    public function toArray(): array
    {
        return \array_filter(
            [
            'tag' => $this->getTag(),
            'email_id' => $this->getEmailId(),
            'message_contents' => $this->getMessageContent(),
            'tasks' => $this->getTaskBag(),
            'sender_credentials' => $this->getSenderCredentials(),
            ],
            static fn ($item) => !\is_null($item)
        );
    }
}
