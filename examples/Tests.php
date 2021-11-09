<?php
require_once '../vendor/autoload.php';

use SmartEmailing\SmartEmailing;

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Tests-Aliveness_test
 */
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->tests()
    ->aliveness()
    ->getMessage();
var_dump($list); //string(29) 'Hi there! API version 3 here!'

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Tests-Login_test_with_GET
 */
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->tests()
    ->getLogin()
    ->getMessage();
var_dump($list); //string(37) 'Hi there! Your credentials are valid!'

/**
 * https://app.smartemailing.cz/docs/api/v3/index.html#api-Tests-Login_test_with_POST
 */
$list = (new SmartEmailing('usrname', 'apiKey'))
    ->tests()
    ->postLogin()
    ->getMessage();
var_dump($list); //string(37) 'Hi there! Your credentials are valid!'
