<?php
require_once '../../vendor/autoload.php';

use SmartEmailing\SmartEmailing;

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Custom_campaigns-Send_bulk_custom_emails
 */
// new Model Instance
$newEmail = new \SmartEmailing\Api\Model\CustomEmail(
    new \SmartEmailing\Api\Model\SenderCredentials(
        'info@smartemailing.cz',
        'Martin',
        'martin@smartemailing.cz'
    ),
    'Test',
    1
);
$newEmail->getTaskBag()
    ->add(
        new \SmartEmailing\Api\Model\Task(
            new \SmartEmailing\Api\Model\Recipient(
                'your-client@email.cz'
            ),
            (new \SmartEmailing\Api\Model\Bag\ReplaceBag())
                ->add(
                    new \SmartEmailing\Api\Model\Replace(
                    'call_reminder',
                    'test value'
                    )
                )
        )
    );
// Call Request
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->customCampaigns()
    ->emailBulk($newEmail);

// Get Response
var_dump($list->getData());
// Response Object toString
echo (string)$list; //
/*
{
  'statusCode': 201,
  'status': 'created',
  'data': [
    {
      'recipient': 'your-client@email.cz',
      'id': '68dcdafee18.....966a1f07dc54'
    }
  ],
  'message': ''
}
 */
