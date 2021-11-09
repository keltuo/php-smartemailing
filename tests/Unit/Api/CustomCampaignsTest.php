<?php
declare(strict_types=1);

namespace SmartEmailing\Test\Unit\Api;

use GuzzleHttp\Psr7\Response;
use SmartEmailing\Api\Model\Attachment;
use SmartEmailing\Api\Model\Bag\ReplaceBag;
use SmartEmailing\Api\Model\Contact\SenderCredentials;
use SmartEmailing\Api\Model\CustomEmail;
use SmartEmailing\Api\Model\Recipient;
use SmartEmailing\Api\Model\RecipientSms;
use SmartEmailing\Api\Model\Replace;
use SmartEmailing\Api\Model\Sms;
use SmartEmailing\Api\Model\Task;
use SmartEmailing\Api\Model\TransactionalEmail;
use SmartEmailing\Test\TestCase;

class CustomCampaignsTest extends TestCase
{
    public function testShouldSendSmsBulk(): void
    {
        $expectedArray = '{
            "status": "created",
            "meta": []
        }';

        $smsBulk = new Sms('Two factor auth SMS', 3);
        $smsBulk->getTaskBag()
            ->add(new Task(
                new RecipientSms('martin@smartemailing.cz', '+420720123456'),
                (new ReplaceBag())
                    ->add(new Replace('two_factor_code', 'DFHG5E'))
                    ->add(new Replace('location', 'Prague'))
            ))
            ->add(new Task(
                new RecipientSms('honza@smartemailing.cz', '+44 123 456 789 0'),
                (new ReplaceBag())
                    ->add(new Replace('two_factor_code', 'LBFT32'))
                    ->add(new Replace('location', 'London'))
            ));


        $this->assertEquals(
            json_decode($this->getExpectedSmsRequest(), true),
            json_decode(json_encode($smsBulk), true)
        );

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with('send/custom-sms-bulk', $smsBulk->toArray())
            ->will($this->returnValue(
                new Response(201, [], $expectedArray))
            )
        ;

        /** @var \SmartEmailing\Api\CustomCampaigns $api */
        $response = $api->smsBulk($smsBulk);
        $expectedObject = json_decode($expectedArray);
        $this->assertEquals(
            [],
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

    public function testShouldSendCustomEmails(): void
    {
        $expectedArray = '{
            "status": "created",
            "meta": [],
            "data": [
                {
                    "recipient": "martin@smartemailing.cz",
                    "id": "bb56f6cb1da34c42a70855e6179e0fa0"
                },
                {
                    "recipient": "honza@smartemailing.cz",
                    "id": "6e5190a612464c1da8d69dcd968cd034"
                }
            ]
        }';

        $customEmail = new CustomEmail(
            new SenderCredentials(
                'martin@smartemailing.cz',
                'Martin',
                'martin@smartemailing.cz'
            ),
            'bulk_1',
            71
        );
        $task = new Task(
            new Recipient('martin@smartemailing.cz'),
            (new ReplaceBag())
                ->add(new Replace(
                    'header_block',
                    "<h1>{% if df_gender == 'M' %}Hi man!{% elseif df_gender == 'F' %}Hello lady!{% else %}Howdy!{% endif %}</h1>"
                ))
                ->add(new Replace('footer', 'Bye!'))
        );
        $task->addTemplateVariable('order_id', '0037565');
        $task->addTemplateVariable('products', [
            [
                'name' => 'Red car',
                'description' => 'lightning fast!',
                'image_url' => 'https://upload.wikimedia.org/wikipedia/en/8/82/Lightning_McQueen.png'
            ],
            [
                'name' => 'Zed\'s chopper',
                'description' => 'It\'s not a motorcycle, baby. It\'s a chopper.',
                'image_url' => 'http://www.imcdb.org/i013795.jpg'
            ]
        ]);
        $customEmail->getTaskBag()
            ->add($task)
            ->add(new Task(
                new Recipient('honza@smartemailing.cz'),
                (new ReplaceBag())
                    ->add(new Replace(
                        'header_block',
                        "<h1>What happened to my Honda?</h1>"
                    ))
                    ->add(new Replace('footer', 'See you!'))
            ));


        $this->assertEquals(
            json_decode($this->getExpectedCustomEmailRequest(), true),
            json_decode(json_encode($customEmail), true)
        );

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with('send/custom-emails-bulk', $customEmail->toArray())
            ->will($this->returnValue(
                new Response(201, [], $expectedArray))
            )
        ;

        /** @var \SmartEmailing\Api\CustomCampaigns $api */
        $response = $api->emailBulk($customEmail);
        $expectedObject = json_decode($expectedArray);
        $this->assertEquals(
            $expectedObject->data,
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

    public function testShouldSendTransactionalEmails(): void
    {
        $expectedArray = '{
            "status": "created",
            "meta": [],
            "data": [
                {
                    "recipient": "martin@smartemailing.cz",
                    "id": "bb56f6cb1da34c42a70855e6179e0fa0"
                },
                {
                    "recipient": "honza@smartemailing.cz",
                    "id": "6e5190a612464c1da8d69dcd968cd034"
                }
            ]
        }';

        $transactionalEmail = new TransactionalEmail(
            new SenderCredentials(
                'martin@smartemailing.cz',
                'Martin',
                'martin@smartemailing.cz'
            ),
            'transactional_1',

        );
        $transactionalEmail->setEmailId(14);
        $task = new Task(
            new Recipient('martin@smartemailing.cz'),
            (new ReplaceBag())
                ->add(new Replace(
                    'header_block',
                    "<h1>{% if df_gender == 'M' %}Hi man!{% elseif df_gender == 'F' %}Hello lady!{% else %}Howdy!{% endif %}</h1>"
                ))
                ->add(new Replace('footer_block', 'Bye!'))
        );
        $task->addTemplateVariable('order_id', '0037565');
        $task->addTemplateVariable('products', [
            [
                'name' => 'Red car',
                'description' => 'lightning fast!',
                'image_url' => 'https://upload.wikimedia.org/wikipedia/en/8/82/Lightning_McQueen.png'
            ],
            [
                'name' => 'Zed\'s chopper',
                'description' => 'It\'s not a motorcycle, baby. It\'s a chopper.',
                'image_url' => 'http://www.imcdb.org/i013795.jpg'
            ]
        ]);
        $task->getAttachmentsBag()
            ->add(new Attachment('Invoice.pdf', 'application/pdf', '...'))
            ->add(new Attachment('TermsAndConditions.pdf', 'application/pdf', '...'));
        $transactionalEmail->getTaskBag()
            ->add($task)
            ->add(new Task(
                new Recipient('honza@smartemailing.cz'),
                (new ReplaceBag())
                    ->add(new Replace(
                        'header_block',
                        "<h1>What happened to my Honda?</h1>"
                    ))
                    ->add(new Replace('footer_block', 'See you!'))
            ));

        $this->assertEquals(
            json_decode($this->getExpectedTransactionalEmailRequest(), true),
            json_decode(json_encode($transactionalEmail), true)
        );

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with('send/transactional-emails-bulk', $transactionalEmail->toArray())
            ->will($this->returnValue(
                new Response(201, [], $expectedArray))
            )
        ;

        /** @var \SmartEmailing\Api\CustomCampaigns $api */
        $response = $api->sendTransactional($transactionalEmail);
        $expectedObject = json_decode($expectedArray);
        $this->assertEquals(
            $expectedObject->data,
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

    protected function getExpectedSmsRequest(): string
    {
        return '
            {
                "tag": "Two factor auth SMS",
                "sms_id": 3,
                "tasks": [
                    {
                        "recipient": {
                            "emailaddress": "martin@smartemailing.cz",
                            "cellphone": "+420720123456"
                        },
                        "replace": [
                            {
                              "key": "two_factor_code",
                              "content": "DFHG5E"
                            },
                            {
                              "key": "location",
                              "content": "Prague"
                            }
                        ],
                        "attachments": []
                    },
                    {
                        "recipient": {
                            "emailaddress": "honza@smartemailing.cz",
                            "cellphone": "+44 123 456 789 0"
                        },
                        "replace": [
                            {
                              "key": "two_factor_code",
                              "content": "LBFT32"
                            },
                            {
                              "key": "location",
                              "content": "London"
                            }
                        ],
                        "attachments": []
                    }
                ]
            }
        ';
    }

    protected function getExpectedCustomEmailRequest(): string
    {
        return '
            {
                "sender_credentials": {
                    "from": "martin@smartemailing.cz",
                    "reply_to": "martin@smartemailing.cz",
                    "sender_name": "Martin"
                },
                "tag": "bulk_1",
                "email_id": 71,
                "tasks": [
                    {
                        "recipient": {
                            "emailaddress": "martin@smartemailing.cz"
                        },
                        "replace": [
                            {
                              "key": "header_block",
                              "content": "<h1>{% if df_gender == \'M\' %}Hi man!{% elseif df_gender == \'F\' %}Hello lady!{% else %}Howdy!{% endif %}</h1>"
                            },
                            {
                              "key": "footer",
                              "content": "Bye!"
                            }
                        ],
                        "template_variables": {
                            "order_id": "0037565",
                            "products": [
                                {
                                    "name": "Red car",
                                    "description": "lightning fast!",
                                    "image_url": "https://upload.wikimedia.org/wikipedia/en/8/82/Lightning_McQueen.png"
                                },
                                {
                                    "name": "Zed\'s chopper",
                                    "description": "It\'s not a motorcycle, baby. It\'s a chopper.",
                                    "image_url": "http://www.imcdb.org/i013795.jpg"
                                }
                            ]
                        },
                        "attachments": []
                    },
                    {
                        "recipient": {
                            "emailaddress": "honza@smartemailing.cz"
                        },
                        "replace": [
                            {
                              "key": "header_block",
                              "content": "<h1>What happened to my Honda?</h1>"
                            },
                            {
                              "key": "footer",
                              "content": "See you!"
                            }
                        ],
                        "attachments": []
                    }
                ]
            }
        ';
    }

    protected function getExpectedTransactionalEmailRequest(): string
    {
        return '
            {
                "sender_credentials": {
                    "from": "martin@smartemailing.cz",
                    "reply_to": "martin@smartemailing.cz",
                    "sender_name": "Martin"
                },
                "tag": "transactional_1",
                "email_id": 14,
                "tasks": [
                    {
                        "recipient": {
                            "emailaddress": "martin@smartemailing.cz"
                        },
                        "replace": [
                            {
                              "key": "header_block",
                              "content": "<h1>{% if df_gender == \'M\' %}Hi man!{% elseif df_gender == \'F\' %}Hello lady!{% else %}Howdy!{% endif %}</h1>"
                            },
                            {
                              "key": "footer_block",
                              "content": "Bye!"
                            }
                        ],
                        "template_variables": {
                            "order_id": "0037565",
                            "products": [
                                {
                                    "name": "Red car",
                                    "description": "lightning fast!",
                                    "image_url": "https://upload.wikimedia.org/wikipedia/en/8/82/Lightning_McQueen.png"
                                },
                                {
                                    "name": "Zed\'s chopper",
                                    "description": "It\'s not a motorcycle, baby. It\'s a chopper.",
                                    "image_url": "http://www.imcdb.org/i013795.jpg"
                                }
                            ]
                        },
                        "attachments": [
                            {
                                "file_name": "Invoice.pdf",
                                "content_type": "application/pdf",
                                "data_base64": "..."
                            },
                            {
                                "file_name": "TermsAndConditions.pdf",
                                "content_type": "application/pdf",
                                "data_base64": "..."
                            }
                        ]
                    },
                    {
                        "recipient": {
                            "emailaddress": "honza@smartemailing.cz"
                        },
                        "replace": [
                            {
                              "key": "header_block",
                              "content": "<h1>What happened to my Honda?</h1>"
                            },
                            {
                              "key": "footer_block",
                              "content": "See you!"
                            }
                        ],
                        "attachments": []
                    }
                ]
            }
        ';
    }

    protected function getApiClass(): string
    {
        return \SmartEmailing\Api\CustomCampaigns::class;
    }
}
