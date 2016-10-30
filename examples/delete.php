<?php

/**
 * @file
 * Presshub article delete example.
 */

require '../vendor/autoload.php';
require '../autoload.php';

// Initialize Presshub Client object.
$api = new Presshub\Client('YOUR_PRESSHUB_API_KEY');

// Delete article from AppleNews and Twitter
// Please note not all services support delete operation via API.
$result = $api->setServices([
      'AppleNews' => [],
      'Twitter'   => []
  ])
  ->delete('POST_ID')
  ->execute();

var_dump($result);
