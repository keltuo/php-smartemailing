<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model;

use JetBrains\PhpStorm\ArrayShape;
use SmartEmailing\Api\Model\Bag\ReplaceBag;

class Email extends AbstractModel
{
    /**
     * E-mail subject 
     */
    protected string $title;
    /**
     * HTML body, not required if textbody is provided 
     */
    protected ?string $htmlBody;
    /**
     * Plain text body. Not required if htmlbody is provided.
     * Every e-mail must have plain text version, so it will be generated from htmlbody if only html_body is provided.
     * It's possible to use variables like {{df_emailaddress}} in both html and text body;
     * those will be replaced with their respective values.
     */
    protected ?string $textBody;
    /**
     * true if this E-mail should be template, false if it shouldn't.
     */
    protected ?bool $template;
    /**
     * Custom footer ID or NULL
     */
    protected ?int $footerId;

    /**
     * @param string      $title
     * @param string|null $htmlBody
     * @param string|null $textBody
     * @param bool|null   $template
     * @param int|null    $footerId
     */
    public function __construct(
        string $title,
        ?string $htmlBody = null,
        ?string $textBody = null,
        ?bool $template = null,
        ?int $footerId = null
    ) {
        $this->setTitle($title);
        $this->setHtmlBody($htmlBody);
        $this->setTextBody($textBody);
        $this->setIsTemplate($template);
        $this->setFooterId($footerId);
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): Email
    {
        $this->title = $title;
        return $this;
    }

    public function getHtmlBody(): ?string
    {
        return $this->htmlBody;
    }

    public function setHtmlBody(?string $htmlBody): Email
    {
        $this->htmlBody = $htmlBody;
        return $this;
    }

    public function getTextBody(): ?string
    {
        return $this->textBody;
    }

    public function setTextBody(?string $textBody): Email
    {
        $this->textBody = $textBody;
        return $this;
    }

    public function getTemplate(): ?bool
    {
        return $this->template;
    }

    public function setIsTemplate(?bool $template): Email
    {
        $this->template = $template;
        return $this;
    }

    public function getFooterId(): ?int
    {
        return $this->footerId;
    }

    public function setFooterId(?int $footerId): Email
    {
        $this->footerId = $footerId;
        return $this;
    }

    #[ArrayShape(
        [
        'title' => "string",
        'htmlbody' => "null|string",
        'textbody' => "null|string",
        'template' => "bool|null",
        'footer_id' => "int|null"
        ]
    )]
    public function toArray(): array
    {
        return [
            'title' => $this->getTitle(),
            'htmlbody' => $this->getHtmlBody(),
            'textbody' => $this->getTextBody(),
            'template' => $this->getTemplate(),
            'footer_id' => $this->getFooterId(),
        ];
    }
}
