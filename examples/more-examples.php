<?php

/**
 * @file
 * Presshub article preview example.
 */

require '../vendor/autoload.php';
require '../autoload.php';

// Initialize Presshub Client object.
$client = new Presshub\Client('YOUR_PRESSHUB_API_KEY');

// Get templates
$result = $client->getTemplates()
  ->execute();

// Get template info
$result = $client->getTemplate('basic')
  ->execute();

// Get services
$result = $client->getServices()
  ->execute();

// Get service info
$result = $client->getService('AppleNews')
  ->execute();

// Get Apple News sections
$result = $client->getAppleNewsSections()
  ->execute();

// Get articles
$result = $client->getArticles()
  ->execute();

// Get article info
$result = $client->getArticle('POST_ID')
  ->execute();
