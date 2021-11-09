<?php
require_once '../../vendor/autoload.php';

use SmartEmailing\SmartEmailing;

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Contacts_in_lists-Get_all_Contacts_in_list
 */
// Call Request
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->contactLists()
    ->getAllConfirmedContacts(1);

// Get Response
var_dump($list->getData());
// Response Object toString
echo (string)$list; //
/*
{
  'statusCode': 200,
  'status': 'ok',
  'meta': {
    'displayed_count': 6,
    'total_count': 6,
    'limit': 500,
    'offset': 0
  },
  'data': [
    {
      'guid': '3680cee6-...-002590a1e8b2',
      'language': 'cs_CZ',
      'created': '2016-11-09 16:50:18',
      'updated': '2021-04-13 13:43:06',
      'blacklisted': 1,
      'emailaddress': 'test@youmails.cz',
      'is_confirmed': 1,
      'domain': 'youmails.cz',
      'name': 'John',
      'surname': 'Doe',
      'birthday': '1993-12-28',
      'nameday': '2012-06-18',
      'salution': 'Johne',
      'salutionsurname': 'Doe',
      'salutiongender': 'Vážený pane',
      'salution_gender_title': 'Pane',
      'town': 'Praha',
      'postalcode': '16000',
      'notes': 'User ID: 144718',
      'phone': '123456789',
      'cellphone': '123456789',
      'gender': 'M',
      'softbounced': 0,
      'hardbounced': 0,
      'last_opened': '2017-04-11 15:30:17',
      'id': 1,
      'customfields_url': 'https://app.smartemailing.cz/api/v3/contact-customfields?contact_id\u003d1',
      'contactlists': [
        {
          'contactlist_id': 1,
          'contact_id': 35627,
          'status': 'unsubscribed',
          'added': '2016-11-09 16:50:18',
          'updated': '2017-04-11 14:49:04'
        }
      ]
    },
      ..... others results
  ],
  'message': ''
}
 */
