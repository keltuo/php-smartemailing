<?php
declare(strict_types=1);

namespace SmartEmailing\Api;


use SmartEmailing\Api\Model\Response\BaseResponse as Response;
use \SmartEmailing\Api\Model\Newsletter as NewsletterModel;

/**
 * @see     https://app.smartemailing.cz/docs/api/v3/index.html#api-Newsletter
 * @package SmartEmailing\Api
 */
class Newsletter extends AbstractApi
{
    /**
     * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Newsletter-Create_newsletter
     */
    public function create(NewsletterModel $newsletter): Response
    {
        return new Response($this->post('newsletter', $newsletter->toArray()));
    }
}
