<?php
declare(strict_types=1);

namespace SmartEmailing\Api;

use SmartEmailing\Api\Model\Bag\OrderBag;
use SmartEmailing\Api\Model\Order;
use SmartEmailing\Api\Model\Response\BaseResponse as Response;

/**
 * @see     https://app.smartemailing.cz/docs/api/v3/index.html#api-E_shops
 * @package SmartEmailing\Api
 */
class Eshops extends AbstractApi
{
    /**
     * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-E_shops-Add_or_update_order
     */
    public function createOrUpdateOrder(Order $order): Response
    {
        return new Response($this->post('orders', $order->toArray()));
    }

    /**
     * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-E_shops-Add_or_update_orders_in_bulk
     */
    public function importOrders(OrderBag $orderBag): ?Response
    {
        if (!$orderBag->isEmpty()) {
            $originalOrders = $orderBag->getItems();
            $lastResponse = null;
            foreach (array_chunk($originalOrders, $this->chunkLimit) as $orders) {
                $chunkOrderBag = (new OrderBag())->setItems($orders);
                $lastResponse = new Response($this->post('orders-bulk', $chunkOrderBag->toArray()));
            }
            return $lastResponse;
        }
        return null;
    }
}
