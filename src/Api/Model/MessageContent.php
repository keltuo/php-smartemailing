<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model;


use JetBrains\PhpStorm\ArrayShape;

class MessageContent extends AbstractModel
{
    /**
     * Subject of email 
     */
    protected string $subject;
    /**
     * HTML contents of email
     * All dynamic fields in E-mail will be customized per contact.
     */
    protected string $htmlBody;
    /**
     * Text contents of email
     * All dynamic fields in E-mail will be customized per contact.
     */
    protected string $textBody;

    /**
     * @param string $subject
     * @param string $htmlBody
     * @param string $textBody
     */
    public function __construct(string $subject, string $htmlBody, string $textBody)
    {
        $this->setSubject($subject);
        $this->setHtmlBody($htmlBody);
        $this->setTextBody($textBody);
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): MessageContent
    {
        $this->subject = $subject;
        return $this;
    }

    public function getHtmlBody(): string
    {
        return $this->htmlBody;
    }

    public function setHtmlBody(string $htmlBody): MessageContent
    {
        $this->htmlBody = $htmlBody;
        return $this;
    }

    public function getTextBody(): string
    {
        return $this->textBody;
    }

    public function setTextBody(string $textBody): MessageContent
    {
        $this->textBody = $textBody;
        return $this;
    }

    #[ArrayShape(
        [
        'subject' => "string",
        'html_body' => "string",
        'text_body' => "string"
        ]
    )]
    public function toArray(): array
    {
        return [
            'subject' => $this->getSubject(),
            'html_body' => $this->getHtmlBody(),
            'text_body' => $this->getTextBody()
        ];
    }
}
