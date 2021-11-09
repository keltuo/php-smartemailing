<?php
require_once '../../vendor/autoload.php';

use SmartEmailing\SmartEmailing;

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Custom_campaigns-Send_bulk_custom_SMS
 */
// new Model Instance
$newSms = new \SmartEmailing\Api\Model\Sms('Test', 1);
$newSms->getTaskBag()
    ->add(
        new \SmartEmailing\Api\Model\Task(
            new \SmartEmailing\Api\Model\RecipientSms(
                'your-client@email.cz',
                '+420123456789'
            ),
            (new \SmartEmailing\Api\Model\Bag\ReplaceBag())
                ->add(
                    new \SmartEmailing\Api\Model\Replace(
                    'replace_call_reminder',
                    'test value'
                    )
                )
        )
    );
// Call Request
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->customCampaigns()
    ->smsBulk($newSms);

// Get Response
var_dump($list->getData());
// Response Object toString
echo (string)$list; //
/*
{
  'statusCode': 201,
  'status': 'created',
  'data': [],
  'message': ''
}
 */
