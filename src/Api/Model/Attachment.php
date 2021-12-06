<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model;

use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

class Attachment extends AbstractModel implements ModelInterface
{
    protected string $fileName;

    protected string $contentType;

    protected string $fileData;

    public function __construct(string $fileName, string $contentType, string $fileData)
    {
        $this->setFileName($fileName);
        $this->setContentType($contentType);
        $this->setFileData($fileData);
    }

    #[Pure]
    public function getIdentifier(): string
    {
        return $this->getFileName();
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): Attachment
    {
        $this->fileName = $fileName;
        return $this;
    }

    public function getContentType(): string
    {
        return $this->contentType;
    }

    public function setContentType(string $contentType): Attachment
    {
        $this->contentType = $contentType;
        return $this;
    }

    public function getFileData(): string
    {
        return $this->fileData;
    }

    public function setFileData(string $fileData): Attachment
    {
        $this->fileData = $fileData;
        return $this;
    }

    #[ArrayShape(
        [
        'file_name' => "string",
        'content_type' => "string",
        'data_base64' => "string",
        ]
    )]
    public function toArray(): array
    {
        return [
            'file_name' => $this->getFileName(),
            'content_type' => $this->getContentType(),
            'data_base64' => $this->getFileData(),
        ];
    }
}
