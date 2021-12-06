<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model\Response;

use JetBrains\PhpStorm\ArrayShape;
use Psr\Http\Message\ResponseInterface;
use SmartEmailing\Api\Model\PropertyTrait;
use SmartEmailing\Exception\RequestException;

class BaseResponse implements \JsonSerializable, \Stringable
{
    use PropertyTrait;

    public const HTTP_ERROR_CODE = 500;
    public const HTTP_BAD_REQUEST_CODE = 400;
    public const HTTP_UNAUTHORIZED_CODE = 401;
    public const HTTP_FORBIDDEN_CODE = 403;
    public const HTTP_NOT_FOUND_CODE = 404;
    public const HTTP_CONFLICT_CODE = 409;
    public const HTTP_UNPROCESSABLE_ENTITY_CODE = 422;
    public const HTTP_METHOD_NOT_ALLOWED_CODE = 405;
    public const HTTP_SUCCESS_CODE = 200;
    public const HTTP_CREATED_CODE = 201;
    public const HTTP_NOT_CONTENT_CODE = 204;
    public const ERROR = 'error';
    public const SUCCESS = 'ok';
    public const CREATED = 'created';

    protected array $data = [];

    protected ?object $meta = null;

    protected string $message = '';

    protected string $status = self::ERROR;

    private ?ResponseInterface $response;

    public function __construct(?ResponseInterface $response = null)
    {
        $this->response = $response;
        $json = \json_decode((string)$response?->getBody());

        if (\is_object($json) && \property_exists($json, 'data')) {
            $this->data = (array)$json->data;
        }

        if (\is_object($json) && \property_exists($json, 'meta')) {
            $this->meta = empty($json->meta) ? null : $json->meta;
        }

        if (\is_object($json) && \property_exists($json, 'status')) {
            $this->json = $json;
            $this->setPropertyValue('status')
                ->setPropertyValue('message');
        }

        $this->status = match ($this->getStatusCode()) {
            self::HTTP_SUCCESS_CODE, 202, 203, self::HTTP_NOT_CONTENT_CODE, 205, 206, 207 => self::SUCCESS,
            self::HTTP_CREATED_CODE => self::CREATED,
            default => self::ERROR
        };

        if ($this->getStatus() === self::ERROR) {
            $errorMessage = $this->getMessage();
            throw new RequestException(
                $this,
                null,
                "Client error: {$errorMessage}",
                $this->getStatusCode()
            );
        }
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getMeta(): ?object
    {
        return $this->meta;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getResponse(): ?ResponseInterface
    {
        return $this->response;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function isSuccess(): bool
    {
        return $this->status === self::SUCCESS || $this->status === self::CREATED;
    }

    public function getStatusCode(): int
    {
        if (\is_null($this->getResponse())) {
            return self::HTTP_ERROR_CODE;
        }

        return $this->getResponse()->getStatusCode();
    }

    #[ArrayShape(
        [
        'statusCode' => "int",
        'status' => "string",
        'meta' => "null|object",
        'data' => "array",
        'message' => "string",
        ]
    )]
    public function toArray(): array
    {
        return [
            'statusCode' => $this->getStatusCode(),
            'status' => $this->getStatus(),
            'meta' => $this->getMeta(),
            'data' => $this->getData(),
            'message' => $this->getMessage(),
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function __toString(): string
    {
        return (string)\json_encode($this);
    }
}
