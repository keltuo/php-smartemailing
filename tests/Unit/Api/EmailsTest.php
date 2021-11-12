<?php
declare(strict_types=1);

namespace SmartEmailing\Test\Unit\Api;

use GuzzleHttp\Psr7\Response;
use SmartEmailing\Api\Contacts;
use SmartEmailing\Api\Emails;
use SmartEmailing\Api\Model\Email;
use SmartEmailing\Api\Model\Response\BaseResponse;
use SmartEmailing\Test\TestCase;
use SmartEmailing\Util\Helpers;

class EmailsTest extends TestCase
{
    public function testShouldCreateEmailFromTemplate(): void
    {
        $expectedArray = '{
          "statusCode": 200,
          "status": "ok",
          "data": {
            "email_id": 472
          },
          "message": ""
        }';
        $template = new \SmartEmailing\Api\Model\EmailTemplate(
            48,
            (new \SmartEmailing\Api\Model\Bag\ReplaceBag())
                ->add(new \SmartEmailing\Api\Model\Replace(
                    'product_12_name',
                    'Red car'
                ))
                ->add(new \SmartEmailing\Api\Model\Replace(
                        'product_12_description',
                        'Bright red car is always the best')
                )
        );

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with('emails/create-from-template', $template->toArray())
            ->will($this->returnValue(
                new Response(200, [], $expectedArray))
            )
        ;

        /** @var \SmartEmailing\Api\Emails $api */
        $response = $api->createFromTemplate($template);
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

    public function testShouldCreateNewEmail(): void
    {
        $expectedArray = '{
            "status": "created",
            "meta": [],
            "data": {
                "attachments": [],
                "id": 40,
                "footer_id": null,
                "title": "Hello world, this is Subject!",
                "created": "2016-11-08 19:36:23",
                "structure": null,
                "textbody": "Hello!",
                "htmlbody": "&#x3C;span&#x3E;Hello!&#x3C;/span&#x3E;",
                "name": "Internal name of this e-mail, public will not see it",
                "template": false
            }
        }';
        $email = new \SmartEmailing\Api\Model\Email(
            'Hello world, this is Subject!',
            'Internal name of this e-mail, public will not see it',
            '&#x3C;span&#x3E;Hello!&#x3C;/span&#x3E;',
        );

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with('emails', $email->toArray())
            ->will($this->returnValue(
                new Response(201, [], $expectedArray))
            )
        ;

        /** @var \SmartEmailing\Api\Emails $api */
        $response = $api->create($email);
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

    public function testShouldGetList(): void
    {
        $expectedArray = $this->getExpectedData();

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('emails', (new \SmartEmailing\Api\Model\Search\Emails())->toArray())
            ->will($this->returnValue(
                new Response(200, [], $expectedArray))
            )
        ;

        /** @var Emails $api */
        $response = $api->getList(new \SmartEmailing\Api\Model\Search\Emails());
        $expectedObject = json_decode($expectedArray);
        $this->assertEquals(
            $expectedObject->data,
            $response->getData()
        );
        $this->assertEquals(
            $expectedObject->meta,
            $response->getMeta()
        );
        $this->assertEquals(
            $expectedObject->status,
            $response->getStatus()
        );
        $this->assertTrue($response->isSuccess());
    }

    public function testShouldGetListConfirmation(): void
    {
        $expectedArray = $this->getExpectedConfirmationData();

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('confirmation-emails', (new \SmartEmailing\Api\Model\Search\Emails())->toArray())
            ->will($this->returnValue(
                new Response(200, [], $expectedArray))
            )
        ;

        /** @var Emails $api */
        $response = $api->getConfirmationList(new \SmartEmailing\Api\Model\Search\Emails());
        $expectedObject = json_decode($expectedArray);
        $this->assertEquals(
            $expectedObject->data,
            $response->getData()
        );
        $this->assertEquals(
            $expectedObject->meta,
            $response->getMeta()
        );
        $this->assertEquals(
            $expectedObject->status,
            $response->getStatus()
        );
        $this->assertTrue($response->isSuccess());
    }

    public function testShouldGetSingle(): void
    {
        $expectedArray = $this->getExpectedSingleData();

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with(Helpers::replaceUrlParameters(
                'emails/:id',
                [
                    'id' => 5
                ]
            ))
            ->will($this->returnValue(
                new Response(200, [], $expectedArray))
            )
        ;

        /** @var Emails $api */
        $response = $api->getSingle(5);
        $expectedObject = json_decode($expectedArray);
        $data = (array)$expectedObject->data;
        $this->assertEquals(
            $data,
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

    protected function getExpectedSingleData(): string
    {
        return '
            {
                "status": "ok",
                "meta": [],
                "data": {
                    "attachments": [],
                    "id": 4,
                    "footer_id": null,
                    "title": "smartkampan",
                    "created": "2015-08-01 23:12:43",
                    "structure": null,
                    "textbody": "Hi Nancy!",
                    "htmlbody": "&#x3C;html&#x3E;\n&#x3C;head&#x3E;\n\t&#x3C;title&#x3E;smartkampan&#x3C;/title&#x3E;\n&#x3C;/head&#x3E;\n&#x3C;body&#x3E;Hi &#x3C;b&#x3E;Nancy&#x3C;/b&#x3E;&#x3C;/body&#x3E;\n&#x3C;/html&#x3E;\n",
                    "name": "smartkampan",
                    "template": false
                }
            }
        ';
    }

    protected function getExpectedConfirmationData(): string
    {
        return '
            {
                "status": "ok",
                "meta": {
                    "displayed_count": 1,
                    "total_count": 20,
                    "limit": 1,
                    "offset": 0
                },
                "data": [
                    {
                        "id": 4,
                        "name": "Confirmation e-mail campaign",
                        "title": "Confirmation e-mail campaign",
                        "htmlbody": "&#x3C;html&#x3E;\n&#x3C;head&#x3E;\n\t&#x3C;title&#x3E;smartkampan&#x3C;/title&#x3E;\n&#x3C;/head&#x3E;\n&#x3C;body&#x3E;{{confirmlink}}&#x3C;/b&#x3E;&#x3C;/body&#x3E;\n&#x3C;/html&#x3E;\n",
                        "textbody": "Hi Nancy!",
                        "structure": null,
                        "created": "2018-06-11 23:12:43",
                        "template": true,
                        "footer_id": null,
                        "attachments": [],
                        "track": "{\"utm_source\":\"newsletter\",\"utm_medium\":\"email\",\"utm_campaign\":\"campaign\",\"utm_content\":\"campaign\"}"
                    }
                ]
            }
        ';
    }

    protected function getExpectedData(): string
    {
        return '
            {
                "status": "ok",
                "meta": {
                      "total_count": 26,
                      "displayed_count": 2,
                      "offset": 0,
                      "limit": 2
                },
                "data": [
                      {
                          "attachments": [
                              "l1_dXNlcjItMTYweDE2MC5qcGc1464349087.png"
                          ],
                          "id": 3,
                          "footer_id": null,
                          "title": "subject",
                          "created": "2015-07-27 15:42:07",
                          "structure": null,
                          "textbody": "Hello Johnny!",
                          "htmlbody": "&#x3C;html&#x3E;\n&#x3C;head&#x3E;\n\t&#x3C;title&#x3E;subject&#x3C;/title&#x3E;\n&#x3C;/head&#x3E;\n&#x3C;body&#x3E;\n&#x3C;p&#x3E;Hello Johnny!&#x3C;/p&#x3E;\n&#x3C;/body&#x3E;\n&#x3C;/html&#x3E;\n",
                          "name": "name",
                          "template": false
                      },
                      {
                          "attachments": [],
                          "id": 4,
                          "footer_id": null,
                          "title": "smartkampan",
                          "created": "2015-08-01 23:12:43",
                          "structure": null,
                          "textbody": "Hi! Nancy!",
                          "htmlbody": "&#x3C;html&#x3E;\n&#x3C;head&#x3E;\n\t&#x3C;title&#x3E;smartkampan&#x3C;/title&#x3E;\n&#x3C;/head&#x3E;\n&#x3C;body&#x3E;Hi &#x3C;b&#x3E;Nancy&#x3C;/b&#x3E;&#x3C;/body&#x3E;\n&#x3C;/html&#x3E;\n",
                          "name": "smartkampan",
                          "template": false
                      }
                ]
            }
        ';
    }

    protected function getApiClass(): string
    {
        return Emails::class;
    }
}
