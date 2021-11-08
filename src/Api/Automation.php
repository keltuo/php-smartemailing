<?php
declare(strict_types=1);

namespace SmartEmailing\Api;


use SmartEmailing\Api\Model\Bag\TriggerEventBag;
use SmartEmailing\Api\Model\Response\BaseResponse as Response;

/**
 * @see     https://app.smartemailing.cz/docs/api/v3/index.html#api-Automation
 * @package SmartEmailing\Api
 */
class Automation extends AbstractApi
{
    /**
     * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Automation-Trigger_event
     */
    public function triggerEvent(TriggerEventBag $triggerEventBag): ?Response
    {
        if (!$triggerEventBag->isEmpty()) {
            $originalTriggers = $triggerEventBag->getItems();
            $lastResponse = null;
            foreach (array_chunk($originalTriggers, $this->chunkLimit) as $triggers) {
                $chunkTriggerBag = (new TriggerEventBag())->setItems($triggers);
                $lastResponse = new Response($this->post('trigger-event', $chunkTriggerBag->toArray()));
            }
            return $lastResponse;
        }
        return null;
    }
}
