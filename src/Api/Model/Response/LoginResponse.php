<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model\Response;

use Psr\Http\Message\ResponseInterface;

class LoginResponse extends BaseResponse
{
    protected ?int $account_id = null;

    /**
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);

        if (is_object($this->json) && property_exists($this->json, 'status')) {
            $this->setPropertyValue('account_id');
        }
    }

    public function getAccountId(): ?int
    {
        return $this->account_id;
    }

}
