<?php

/**
 * @file
 * Presshub article preview example.
 */

require '../vendor/autoload.php';
require '../autoload.php';

// Initialize Presshub Client object.
$api = new Presshub\Client('YOUR_PRESSHUB_API_KEY');

// Get templates
$result = $api->getTemplates()
  ->execute();

// Get template info
$result = $api->getTemplate('basic')
  ->execute();

// Get services
$result = $api->getServices()
  ->execute();

// Get service info
$result = $api->getService('AppleNews')
  ->execute();

// Get Apple News sections
$result = $api->getAppleNewsSections()
  ->execute();

// Get articles
$result = $api->getArticles()
  ->execute();

// Get article info
$result = $api->getArticle('POST_ID')
  ->execute();
