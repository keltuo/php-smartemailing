<?php
declare(strict_types=1);

namespace SmartEmailing\Api;


use SmartEmailing\Api\Model\AbstractModel;
use SmartEmailing\Api\Model\Bag\TaskBag;
use SmartEmailing\Api\Model\CustomEmail;
use SmartEmailing\Api\Model\Response\BaseResponse as Response;
use SmartEmailing\Api\Model\Sms;
use SmartEmailing\Api\Model\TransactionalEmail;

/**
 * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Custom_campaigns
 * @package SmartEmailing\Api
 */
class CustomCampaigns extends AbstractApi
{
    /**
     * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Custom_campaigns-Send_bulk_custom_SMS
     */
    public function smsBulk(Sms $sms): ?Response
    {
        return $this->send('send/custom-sms-bulk', $sms, $this->chunkLimit);
    }

    /**
     * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Custom_campaigns-Send_bulk_custom_emails
     */
    public function emailBulk(CustomEmail $customEmail): ?Response
    {
        return $this->send('send/custom-emails-bulk', $customEmail, $this->chunkLimit);
    }

    /**
     * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Custom_campaigns-Send_transactional_emails
     */
    public function sendTransactional(TransactionalEmail $transactionalEmail): ?Response
    {
        return $this->send('send/transactional-emails-bulk', $transactionalEmail, 5);
    }

    protected function send(string $uri, AbstractModel $model, int $chunkLimit): ?Response
    {
        /** @var Sms|TransactionalEmail|CustomEmail $model */
        if (!$model->getTaskBag()->isEmpty()) {
            $originalItems = $model->getTaskBag()->getItems();
            $lastResponse = null;
            foreach (array_chunk($originalItems, $chunkLimit) as $items) {
                /** @var Sms|TransactionalEmail|CustomEmail $chunkModel */
                $chunkModel = clone $model;
                $taskBag = new TaskBag();
                $taskBag->setItems($items);
                $chunkModel->setTaskBag($taskBag);
                $lastResponse = new Response($this->post($uri, $chunkModel->toArray()));
            }
            return $lastResponse;
        }
        return null;
    }
}
