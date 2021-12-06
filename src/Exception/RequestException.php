<?php
declare(strict_types=1);

namespace SmartEmailing\Exception;

use Psr\Http\Message\RequestInterface;
use SmartEmailing\Api\Model\Response\BaseResponse;

class RequestException extends \RuntimeException
{
    private ?RequestInterface $request;
    private BaseResponse $response;

    public function __construct(
        BaseResponse $response,
        ?RequestInterface $request = null,
        string $message = '',
        int $code = 0,
        ?\Throwable $exception = null,
    )
    {
        $this->response = $response;
        $this->request = $request;

        parent::__construct($message, $code, $exception);
    }

    public function getRequest(): ?RequestInterface
    {
        return $this->request;
    }

    public function getResponse(): BaseResponse
    {
        return $this->response;
    }
}
