<?php
require_once '../../vendor/autoload.php';

use SmartEmailing\SmartEmailing;

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-E_shops-Add_or_update_order
 */
// new Model Instance
$newOrder = new \SmartEmailing\Api\Model\Order(
    'your-client@email.cz',
    'Test eshop',
    'ORDER0001'
);
$newOrder->setCreatedAt('2019-01-01 00:00:00');
$newOrder->getAttributeBag()->add(new \SmartEmailing\Api\Model\Attribute(
    'discount',
    'black friday'
));
$newOrder->getOrderItemBag()
    ->add(
        (new \SmartEmailing\Api\Model\OrderItem(
            'ABC123',
            'My product',
            new \SmartEmailing\Api\Model\Price(123.97, 150.00, 'CZK'),
            1,
            'https://www.example.com/my-product'
        ))->setAttributeBag(
            (new \SmartEmailing\Api\Model\Bag\AttributeBag())
            ->add(new \SmartEmailing\Api\Model\Attribute('manufacturer', 'Factory ltd.'))
        )
    )
;

// Call Request
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->eshops()
    ->createOrUpdateOrder($newOrder);

// Get Response
var_dump($list->getData());
// Response Object toString
echo (string)$list; //
/*
{
  'statusCode': 200,
  'status': 'ok',
  'data': {
    'id': '11ec41521c---c1f6ba555ec',
    'created_at': '2019-01-01 00:00:00',
    'contact_id': 1,
    'status': 'placed',
    'eshop_name': 'Test eshop',
    'eshop_code': 'ORDER0001',
    'attributes': [
      {
        'name': 'discount',
        'value': 'black friday'
      }
    ],
    'items': [
      {
        'id': 'ABC123',
        'name': 'My product',
        'price': {
          'without_vat': 123.97,
          'with_vat': 150,
          'currency': 'CZK'
        },
        'quantity': 1,
        'url': 'https://www.example.com/my-product',
        'attributes': [
          {
            'name': 'manufacturer',
            'value': 'Factory ltd.'
          }
        ]
      }
    ]
  },
  'message': ''
}
 */
