<?php
require_once '../../vendor/autoload.php';

use SmartEmailing\SmartEmailing;

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Custom_campaigns-Send_transactional_emails
 */
// new Model Instance
$newEmail = new \SmartEmailing\Api\Model\TransactionalEmail(
    new \SmartEmailing\Api\Model\SenderCredentials(
        'info@smartemailing.cz',
        'Martin',
        'martin@smartemailing.cz'
    ),
    'Test'
);
$newEmail->setEmailId(48);
// OR   (one of these is required)
// $newEmail->setMessageContent($messageContent)
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
    ->sendTransactional($newEmail);

// if returned exception error Client error: Rate limit exceeded.
// you have to contact SmartEmailing support to increase your limit
// or enabled Transactional emails


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
