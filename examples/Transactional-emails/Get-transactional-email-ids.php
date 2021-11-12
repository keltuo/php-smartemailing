<?php
require_once '../../vendor/autoload.php';

use SmartEmailing\SmartEmailing;

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Transactional_emails-Get_transactional_email_ids
 */
// Call Request
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->transactionalEmails()
    ->getListCreated();

// Get Response
var_dump($list->getData());
// Response Object toString
echo (string)$list; //
/*
{
    'status': 'ok',
    'meta': {},
    'data': {
        'Example tag name': 1,
        'Another tag name': 2
    }
}
 */
