<?php
require_once '../../vendor/autoload.php';

use SmartEmailing\SmartEmailing;

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Import-Import_contacts
 */
// new Model Instance
$contact1 = (new \SmartEmailing\Api\Model\Contact\ContactDetail(
    'martin@smartemailing.cz'
))
    ->setName('Martin');
$contact1->getContactListBag()
    ->add(new \SmartEmailing\Api\Model\Contact\ContactList(
        1,
        \SmartEmailing\Api\Model\Contact\ContactList::CONFIRMED
    ))
    ->add(new \SmartEmailing\Api\Model\Contact\ContactList(
        2,
        \SmartEmailing\Api\Model\Contact\ContactList::CONFIRMED
    ));
$contact1->getPurposeBag()
    ->add(new \SmartEmailing\Api\Model\Contact\Purpose(2))
    ->add(new \SmartEmailing\Api\Model\Contact\Purpose(
        2,
        '2018-01-11 10:30:00',
        '2023-01-11 10:30:00'
    ));

$contact2 = clone $contact1;
$contact2->setEmailAddress('martin2@smartemailing.cz');

$contactBag = (new \SmartEmailing\Api\Model\Bag\ContactBag())
    ->add($contact1)
    ->add($contact2);

$importModel = new \SmartEmailing\Api\Model\Import(
    $contactBag,
    new \SmartEmailing\Api\Model\Contact\Settings(
        true,
        true,
        true,
        true,
        true,
        false
    )
);
// Call Request
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->import()
    ->contacts($importModel);

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
      'emailaddress': 'martin2@smartemailing.cz',
      'contact_id': 6722452
    },
    {
      'emailaddress': 'martin@smartemailing.cz',
      'contact_id': 6722449
    }
  ],
  'message': '',
  'contacts_map': [
    {
      'emailaddress': 'martin2@smartemailing.cz',
      'contact_id': 6722452
    },
    {
      'emailaddress': 'martin@smartemailing.cz',
      'contact_id': 6722449
    }
  ]
}

 */
