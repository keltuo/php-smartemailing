<?php
require_once '../../vendor/autoload.php';

use SmartEmailing\SmartEmailing;

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Web_Forms-Get_single_Web_Form_structure
 */
// Call Request
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->webForms()
    ->getSingle(2);

// Get Response
var_dump($list->getData());
// Response Object toString
echo (string)$list; //
/*
{
    'status': 'ok',
    'meta': [],
    'data': {
        'id': 5,
        'guid': 'inslphl79009sop9nt9wbehtz65vqocrlnriarxct6nolih5v7w3qj8vzel0uf00u78ai0rty67ev0as30qigc4uv0bpkimfahk2',
        'name': 'Newsletter subscription',
        'text': 'Hello, welcome to my newsletter subscription form!',
        'text_visible': 1,
        'submit': 'Subscribe now',
        'form_action': 'http://app.smartemailing.cz/public/web-forms/subscribe/2-inslphl79009sop9nt9wbehtz65vqocrlnriarxct6nolih5v7w3qj8vzel0uf00u78ai0rty67ev0as30qigc4uv0bpkimfahk2?posted=1',
        'submit_in_new_window': true,
        'structure': [
            {
                'html_input_type': 'text',
                'html_input_name': 'df_cellphone',
                'label': 'Cell phone',
                'is_required': 0,
                'error_message': null
            },
            {
                'html_input_type': 'text',
                'html_input_name': 'df_emailaddress',
                'label': 'E-mail address',
                'is_required': 1,
                'error_message': 'Please fill-in e-mail address'
            },
            {
                'html_input_type': 'select',
                'html_input_name': 'cf_1',
                'label': 'Select your preference',
                'is_required': 0,
                'error_message': null,
                'options': [
                    {
                        'value': 54,
                        'label': 'Cars'
                    },
                    {
                        'value': 55,
                        'label': 'Motorbikes'
                    },
                    {
                        'value': 56,
                        'label': 'Rocket pants'
                    }
                ]
            },
            {
                'html_input_type': 'text',
                'html_input_name': 'cf_8',
                'label': 'Nickname',
                'is_required': 0,
                'error_message': null
            }
        ],
        'contactlists': [
           {
               'id': 1,
               'status': 'confirmed'
           }
        ],
        'purposes': [
            {
                'html_input_name': 'solicited_purposes[8]',
                'purpose_id': 8,
                'is_primary': 0,
                'checkbox_label': 'I want to recieve blog news',
                'link_label': null,
                'link_href': null
            },
            {
                'html_input_name': 'solicited_purposes[2]',
                'purpose_id': 2,
                'is_primary': 0,
                'checkbox_label': 'I want to be informed about product news in e-shop',
                'link_label': 'Click here for more information',
                'link_href': 'https://my-eshop.com/about-product-news-subscription'
            },
            {
                'html_input_name': null,
                'purpose_id': 5,
                'is_primary': 1,
                'checkbox_label': 'I will send you newsletter twice a week',
                'link_label': 'Read more about my newsletters',
                'link_href': 'https://my-eshop.com/about-newsletter-subscription'
            }
        ]
    }
}
 */
