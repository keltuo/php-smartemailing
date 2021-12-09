<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model\Response;

use JetBrains\PhpStorm\ArrayShape;
use Psr\Http\Message\ResponseInterface;

class LoginResponse extends BaseResponse
{
    protected ?int $account_id = null;

    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);

        if (\property_exists($this->json, 'status')) {
            $this->setPropertyValue('account_id');
        }
    }

    public function getAccountId(): ?int
    {
        return $this->account_id;
    }

    #[ArrayShape(
        [
            'statusCode' => "int",
            'status' => "string",
            'meta' => "null|object",
            'data' => "array",
            'message' => "string",
        ]
    )] public function toArray(): array
    {
        return \array_merge(parent::toArray(), [
            'account_id' => $this->getAccountId(),
        ]);
    }
}
