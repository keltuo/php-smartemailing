<?php
require_once '../../vendor/autoload.php';

use SmartEmailing\SmartEmailing;

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Emails-Get_confirmation_emails
 */
// Call Request
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->emails()
    ->getConfirmationList();

// Call Request with Search filter
$search = (new \SmartEmailing\Api\Model\Search\Emails())
    ->selectBy(\SmartEmailing\Api\Model\Search\Emails::ID)
    ->selectBy(\SmartEmailing\Api\Model\Search\Emails::NAME)
    ->selectBy(\SmartEmailing\Api\Model\Search\Emails::HTML_BODY)
    ->sortBy(\SmartEmailing\Api\Model\Search\Emails::ID, \SmartEmailing\Api\Model\Search\Emails::SORT_DESC)
    ->setLimit(1);
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->emails()
    ->getConfirmationList($search); // Get all with search filter

// Get Response
var_dump($list->getData());
// Response Object toString
echo (string)$list; //
/*
{
    'status': 'ok',
    'meta': {
        'displayed_count': 1,
        'total_count': 20,
        'limit': 1,
        'offset': 0
    },
    'data': [
        {
            'id': 4,
            'name': 'Confirmation e-mail campaign',
            'title': 'Confirmation e-mail campaign',
            'htmlbody': "&#x3C;html&#x3E;\n&#x3C;head&#x3E;\n\t&#x3C;title&#x3E;smartkampan&#x3C;/title&#x3E;\n&#x3C;/head&#x3E;\n&#x3C;body&#x3E;{{confirmlink}}&#x3C;/b&#x3E;&#x3C;/body&#x3E;\n&#x3C;/html&#x3E;\n",
            'textbody': 'Hi Nancy!',
            'structure': null,
            'created': '2018-06-11 23:12:43',
            'template': true,
            'footer_id': null,
            'attachments': [],
            'track': "{\"utm_source\":\"newsletter\",\"utm_medium\":\"email\",\"utm_campaign\":\"campaign\",\"utm_content\":\"campaign\"}"
        }
    ]
}
 */
