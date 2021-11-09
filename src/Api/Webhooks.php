<?php
declare(strict_types=1);

namespace SmartEmailing\Api;


use SmartEmailing\Api\Model\Response\BaseResponse as Response;
use SmartEmailing\Api\Model\Webhook;
use SmartEmailing\Api\Model\Search\Webhooks as SearchWebhooks;

/**
 * @see     https://app.smartemailing.cz/docs/api/v3/index.html#api-Webhooks
 * @package SmartEmailing\Api
 */
class Webhooks extends AbstractApi
{
    /**
     * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Webhooks-Creates_new_webhook
     */
    public function create(Webhook $webhook): Response
    {
        return new Response($this->post('web-hooks', $webhook->toArray()));
    }

    /**
     * https://app.smartemailing.cz/docs/api/v3/index.html#api-Webhooks-Get_Webhooks
     */
    public function getList(SearchWebhooks $search = null): Response
    {
        $search = $search ?? new SearchWebhooks();
        return new Response($this->get('web-hooks', $search->getAsQuery()));
    }

    /**
     * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Webhooks-Deletes_webhook
     */
    public function remove(int $idWebhook): Response
    {
        return new Response(
            $this->delete(
                $this->replaceUrlParameters(
                    'web-hooks/:id',
                    [
                    'id' => $idWebhook
                    ]
                )
            )
        );
    }
}
