<?php
declare(strict_types=1);

namespace SmartEmailing\Test\Unit\Api;

use GuzzleHttp\Psr7\Response;
use SmartEmailing\Api\WebForms;
use SmartEmailing\Test\TestCase;

class WebFormsTest extends TestCase
{
    public function testShouldGetAllWebForms(): void
    {
        $expectedArray = $this->getExpectedData();

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('web-forms')
            ->will($this->returnValue(
                new Response(200, [], $expectedArray))
            )
        ;

        /** @var WebForms $api */
        $response = $api->getList();
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

    public function testShouldGetSingleWebForm(): void
    {
        $expectedArray = $this->getExpectedSingleData();

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('web-form-structure/5')
            ->will($this->returnValue(
                new Response(200, [], $expectedArray))
            )
        ;

        /** @var WebForms $api */
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
                "id": 5,
                "guid": "inslphl79009sop9nt9wbehtz65vqocrlnriarxct6nolih5v7w3qj8vzel0uf00u78ai0rty67ev0as30qigc4uv0bpkimfahk2",
                "name": "Newsletter subscription",
                "text": "Hello, welcome to my newsletter subscription form!",
                "text_visible": 1,
                "submit": "Subscribe now",
                "form_action": "http://app.smartemailing.cz/public/web-forms/subscribe/2-inslphl79009sop9nt9wbehtz65vqocrlnriarxct6nolih5v7w3qj8vzel0uf00u78ai0rty67ev0as30qigc4uv0bpkimfahk2?posted=1",
                "submit_in_new_window": true,
                "structure": [
                    {
                        "html_input_type": "text",
                        "html_input_name": "df_cellphone",
                        "label": "Cell phone",
                        "is_required": 0,
                        "error_message": null
                    },
                    {
                        "html_input_type": "text",
                        "html_input_name": "df_emailaddress",
                        "label": "E-mail address",
                        "is_required": 1,
                        "error_message": "Please fill-in e-mail address"
                    },
                    {
                        "html_input_type": "select",
                        "html_input_name": "cf_1",
                        "label": "Select your preference",
                        "is_required": 0,
                        "error_message": null,
                        "options": [
                            {
                                "value": 54,
                                "label": "Cars"
                            },
                            {
                                "value": 55,
                                "label": "Motorbikes"
                            },
                            {
                                "value": 56,
                                "label": "Rocket pants"
                            }
                        ]
                    },
                    {
                        "html_input_type": "text",
                        "html_input_name": "cf_8",
                        "label": "Nickname",
                        "is_required": 0,
                        "error_message": null
                    }
                ],
                "contactlists": [
                   {
                       "id": 1,
                       "status": "confirmed"
                   }
                ],
                "purposes": [
                    {
                        "html_input_name": "solicited_purposes[8]",
                        "purpose_id": 8,
                        "is_primary": 0,
                        "checkbox_label": "I want to recieve blog news",
                        "link_label": null,
                        "link_href": null
                    },
                    {
                        "html_input_name": "solicited_purposes[2]",
                        "purpose_id": 2,
                        "is_primary": 0,
                        "checkbox_label": "I want to be informed about product news in e-shop",
                        "link_label": "Click here for more information",
                        "link_href": "https://my-eshop.com/about-product-news-subscription"
                    },
                    {
                        "html_input_name": null,
                        "purpose_id": 5,
                        "is_primary": 1,
                        "checkbox_label": "I will send you newsletter twice a week",
                        "link_label": "Read more about my newsletters",
                        "link_href": "https://my-eshop.com/about-newsletter-subscription"
                    }
                ]
            }
        }
        ';
    }

    protected function getExpectedData(): string
    {
        return '
            {
                "status": "ok",
                "meta": {
                    "displayed_count": 1,
                    "total_count": 1,
                    "limit": 500,
                    "offset": 0
                },
                "data": [
                    {
                        "id": 10,
                        "name": "Newsletter subscriptions form"
                    }
                ]
            }
        ';
    }

    protected function getApiClass(): string
    {
        return WebForms::class;
    }
}
