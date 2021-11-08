<?php
declare(strict_types=1);

namespace SmartEmailing\Api;


use SmartEmailing\Api\Model\Response\LoginResponse;
use SmartEmailing\Api\Model\Response\BaseResponse as Response;

/**
 * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Tests
 * @package SmartEmailing\Api
 */
class Tests extends AbstractApi
{
    /**
     * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Tests-Aliveness_test
     */
    public function aliveness(): Response
    {
        return new Response($this->get('ping'));
    }

    /**
     * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Tests-Login_test_with_GET
     */
    public function getLogin(): Response
    {
        return new LoginResponse($this->get('check-credentials'));
    }

    /**
     * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Tests-Login_test_with_POST
     */
    public function postLogin(): Response
    {
        return new LoginResponse($this->post('check-credentials'));
    }
}
