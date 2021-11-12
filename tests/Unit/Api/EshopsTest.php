<?php
declare(strict_types=1);

namespace SmartEmailing\Test\Unit\Api;

use GuzzleHttp\Psr7\Response;
use SmartEmailing\Api\Eshops;
use SmartEmailing\Api\Model\Attribute;
use SmartEmailing\Api\Model\Bag\OrderBag;
use SmartEmailing\Api\Model\FeedItem;
use SmartEmailing\Api\Model\Order;
use SmartEmailing\Api\Model\OrderItem;
use SmartEmailing\Api\Model\Price;
use SmartEmailing\Test\TestCase;

class EshopsTest extends TestCase
{
    public function testShouldImportOrders(): void
    {
        $expectedArray = $this->getExpectedResponse();

        $orderItem1 = (new OrderItem(
                'ABC123',
                'My product',
                new Price(123.97, 150, 'CZK'),
                1,
                'https://www.example.com/my-product'
            ))
            ->setDescription('My product description')
            ->setImageUrl('https://www.example.com/images/my-product.jpg');
        $orderItem1->getAttributeBag()
            ->add(new Attribute('manufacturer', 'Factory ltd.'))
            ->add(new Attribute('my other custom attribute', 'some value'));

        $orderItem2 = (new OrderItem(
            'XYZ789',
            'My another product',
            new Price(165.7, 200.5, 'CZK'),
            2,
            'https://www.example.com/my-another-product'
        ))
            ->setDescription('My another product description')
            ->setImageUrl('https://www.example.com/images/my-another-product.jpg');


        $order1 = new Order('michal@smartemailing.cz', 'my-eshop', 'ORDER0001');
        $order1->setCreatedAt('2019-01-01 00:00:00');
        $order1->getAttributeBag()
            ->add(new Attribute('discount', 'Black friday'));
        $order1->getOrderItemBag()
            ->add($orderItem1)
            ->add($orderItem2);
        $order1->getFeedItemBag()
            ->add(new FeedItem('ZYX987', 'my-feed', 3));

        $order2 = new Order('michal+2@smartemailing.cz', 'my-eshop', 'ORDER0002');
        $order2->setCreatedAt('2019-01-01 00:50:00');
        $orderItem = clone $orderItem1;
        $order2->getOrderItemBag()->add($orderItem->setQuantity(2));

        $importBag = (new OrderBag())
            ->add($order1)
            ->add($order2);

        $this->assertEquals(
            json_decode($this->getExpectedRequest(), true),
            json_decode(json_encode($importBag), true)
        );

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with('orders-bulk', $importBag->toArray())
            ->will($this->returnValue(
                new Response(201, [], $expectedArray))
            );

        /** @var \SmartEmailing\Api\Eshops $api */
        $response = $api->importOrders($importBag);
        $expectedObject = json_decode($expectedArray);
        $this->assertEquals(
            $expectedObject->data,
            $response->getData()
        );
        $this->assertEquals(
            empty($expectedObject->meta) ? null : $expectedObject->meta,
            $response->getMeta()
        );
        $this->assertEquals(
            $expectedObject->status,
            $response->getStatus()
        );
        $this->assertTrue($response->isSuccess());

        $this->assertNull($api->importOrders(new OrderBag()));
    }

    public function testShouldCreateOrder()
    {
        $expectedArray = '{
            "status": "created",
            "meta": [],
            "data": {
                "id": "11e91b137503deb2a4e66c4008be149e",
                "created_at": "2019-01-01 00:00:00",
                "contact_id": 35839,
                "status": "placed",
                "eshop_name": "my-eshop",
                "eshop_code": "ORDER0001",
                "items": [
                    {
                        "id": "ABC123",
                        "name": "My product",
                        "description": "My product description",
                        "price": {
                            "without_vat": 123.97,
                            "with_vat": 150,
                            "currency": "CZK"
                        },
                        "quantity": 1,
                        "url": "https://www.example.com/my-product",
                        "image_url": "https://www.example.com/images/my-product.jpg",
                        "attributes": [
                            {
                                "name": "manufacturer",
                                 "value": "Factory ltd."
                            },
                            {
                                 "name": "my other custom attribute",
                                 "value": "some value"
                            }
                        ]
                    },
                    {
                        "id": "XYZ789",
                        "name": "My another product",
                        "description": "My another product description",
                        "price": {
                            "without_vat": 165.7,
                            "with_vat": 200.5,
                            "currency": "CZK"
                        },
                        "quantity": 2,
                        "url": "https://www.example.com/my-another-product",
                        "image_url": "https://www.example.com/images/my-another-product.jpg"
                    },
                    {
                        "id": "ZYX987",
                        "name": "Product loaded from feed",
                        "description": "Description",
                        "price": {
                            "without_vat": 100.0,
                            "with_vat": 121.0,
                            "currency": "CZK"
                        },
                        "quantity": 3,
                        "url": "https://www.example.com/my-feed-product",
                        "image_url": "https://www.example.com/images/my-feed-product.jpg"
                    }
                ]
            }
        }';

        $orderItem1 = (new OrderItem(
            'ABC123',
            'My product',
            new Price(123.97, 150, 'CZK'),
            1,
            'https://www.example.com/my-product'
        ))
            ->setDescription('My product description')
            ->setImageUrl('https://www.example.com/images/my-product.jpg');
        $orderItem1->getAttributeBag()
            ->add(new Attribute('manufacturer', 'Factory ltd.'))
            ->add(new Attribute('my other custom attribute', 'some value'));

        $orderItem2 = (new OrderItem(
            'XYZ789',
            'My another product',
            new Price(165.7, 200.5, 'CZK'),
            2,
            'https://www.example.com/my-another-product'
        ))
            ->setDescription('My another product description')
            ->setImageUrl('https://www.example.com/images/my-another-product.jpg');


        $order1 = new Order('michal@smartemailing.cz', 'my-eshop', 'ORDER0001');
        $order1->setCreatedAt('2019-01-01 00:00:00');
        $order1->getAttributeBag()
            ->add(new Attribute('discount', 'Black friday'));
        $order1->getOrderItemBag()
            ->add($orderItem1)
            ->add($orderItem2);
        $order1->getFeedItemBag()
            ->add(new FeedItem('ZYX987', 'my-feed', 3));

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with('orders', $order1->toArray())
            ->will($this->returnValue(
                new Response(201, [], $expectedArray))
            )
        ;

        /** @var Eshops $api */
        $response = $api->createOrUpdateOrder($order1);
        $expectedObject = json_decode($expectedArray);
        $this->assertEquals(
            (array)$expectedObject->data,
            $response->getData()
        );
        $this->assertEquals(
            empty($expectedObject->meta) ? null :$expectedObject->meta,
            $response->getMeta()
        );
        $this->assertEquals(
            $expectedObject->status,
            $response->getStatus()
        );
        $this->assertTrue($response->isSuccess());
    }

    protected function getExpectedResponse(): string
    {
        return '
            {
                "status": "created",
                "meta": [],
                "data": [
                    {
                         "id": "11e91b137503deb2a4e66c4008be149e",
                         "created_at": "2019-01-01 00:00:00",
                         "contact_id": 35839,
                         "status": "placed",
                         "eshop_name": "my-eshop",
                         "eshop_code": "ORDER0001",
                         "items": [
                             {
                                 "id": "ABC123",
                                 "name": "My product",
                                 "description": "My product description",
                                 "price": {
                                     "without_vat": 123.97,
                                     "with_vat": 150,
                                     "currency": "CZK"
                                 },
                                 "quantity": 1,
                                 "url": "https://www.example.com/my-product",
                                 "image_url": "https://www.example.com/images/my-product.jpg",
                                 "attributes": [
                                     {
                                          "name": "manufacturer",
                                          "value": "Factory ltd."
                                     },
                                     {
                                         "name": "my other custom attribute",
                                         "value": "some value"
                                     }
                                 ]
                             },
                             {
                                 "id": "XYZ789",
                                 "name": "My another product",
                                 "description": "My another product description",
                                 "price": {
                                     "without_vat": 165.7,
                                     "with_vat": 200.5,
                                     "currency": "CZK"
                                 },
                                 "quantity": 2,
                                 "url": "https://www.example.com/my-another-product",
                                 "image_url": "https://www.example.com/images/my-another-product.jpg"
                             },
                             {
                                 "id": "ZYX987",
                                 "name": "Product loaded from feed",
                                 "description": "Description",
                                 "price": {
                                     "without_vat": 100.0,
                                     "with_vat": 121.0,
                                     "currency": "CZK"
                                 },
                                 "quantity": 3,
                                 "url": "https://www.example.com/my-feed-product",
                                 "image_url": "https://www.example.com/images/my-feed-product.jpg"
                             }
                         ]
                     },
                     {
                         "eshop_name": "my-eshop",
                         "eshop_code": "ORDER0002",
                         "emailaddress": "michal+2@smartemailing.cz",
                         "created_at": "2019-01-01 00:50:00",
                         "attributes": [],
                         "items": [
                             {
                                 "id": "ABC123",
                                 "name": "My product",
                                 "description": "My product description",
                                 "price": {
                                     "without_vat": 123.97,
                                     "with_vat": 150.00,
                                     "currency": "CZK"
                                 },
                                 "quantity": 2,
                                 "url": "https://www.example.com/my-product",
                                 "image_url": "https://www.example.com/images/my-product.jpg",
                                 "attributes": [
                                     {
                                         "name": "manufacturer",
                                         "value": "Factory ltd."
                                     },
                                     {
                                         "name": "my other custom attribute",
                                         "value": "some value"
                                     }
                                 ]
                             }
                         ]
                     }
                 ]
            }
        ';
    }

    protected function getExpectedRequest(): string
    {
        return '
            [
                {
                     "eshop_name": "my-eshop",
                     "eshop_code": "ORDER0001",
                     "emailaddress": "michal@smartemailing.cz",
                     "created_at": "2019-01-01 00:00:00",
                     "attributes": [
                         {
                             "name": "discount",
                             "value": "Black friday"
                         }
                     ],
                     "items": [
                         {
                             "id": "ABC123",
                             "name": "My product",
                             "description": "My product description",
                             "price": {
                                 "without_vat": 123.97,
                                 "with_vat": 150.00,
                                 "currency": "CZK"
                             },
                             "quantity": 1,
                             "url": "https://www.example.com/my-product",
                             "image_url": "https://www.example.com/images/my-product.jpg",
                             "attributes": [
                                 {
                                     "name": "manufacturer",
                                     "value": "Factory ltd."
                                 },
                                 {
                                     "name": "my other custom attribute",
                                     "value": "some value"
                                 }
                             ]
                         },
                         {
                             "id": "XYZ789",
                             "name": "My another product",
                             "description": "My another product description",
                             "price": {
                                 "without_vat": 165.70,
                                 "with_vat": 200.50,
                                 "currency": "CZK"
                             },
                             "quantity": 2,
                             "url": "https://www.example.com/my-another-product",
                             "image_url": "https://www.example.com/images/my-another-product.jpg"
                         }
                     ],
                     "item_feeds": [
                         {
                             "item_id": "ZYX987",
                             "feed_name": "my-feed",
                             "quantity": 3
                         }
                     ]
                },
                {
                     "eshop_name": "my-eshop",
                     "eshop_code": "ORDER0002",
                     "emailaddress": "michal+2@smartemailing.cz",
                     "created_at": "2019-01-01 00:50:00",
                     "items": [
                         {
                             "id": "ABC123",
                             "name": "My product",
                             "description": "My product description",
                             "price": {
                                 "without_vat": 123.97,
                                 "with_vat": 150.00,
                                 "currency": "CZK"
                             },
                             "quantity": 2,
                             "url": "https://www.example.com/my-product",
                             "image_url": "https://www.example.com/images/my-product.jpg",
                             "attributes": [
                                 {
                                     "name": "manufacturer",
                                     "value": "Factory ltd."
                                 },
                                 {
                                     "name": "my other custom attribute",
                                     "value": "some value"
                                 }
                             ]
                         }
                     ]
                }
                ]
        ';
    }

    protected function getApiClass(): string
    {
        return \SmartEmailing\Api\Eshops::class;
    }
}
