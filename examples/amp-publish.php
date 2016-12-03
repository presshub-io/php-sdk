<?php

/**
 * @file
 * Presshub AMP request.
 * This will tell Presshub to generate AMP formatted HTML and send it back to Webhook URL
 * you sepcified when enabled GoogleAmp integration on Presshub.io
 */

require '../vendor/autoload.php';
require '../autoload.php';

// Create Presshub template.
$template = Presshub\Template::create()
  ->setTitle('Your Article Title')
  ->setSubTitle('Your Article Subtitle')
  ->setCanonicalURL( 'http://example.com/your-article-url.html' )
  ->setThumbnail( 'https://example.com/article-thumbnail.jpg' )
  ->setKeywords(['Keyword1', 'Keyword2', 'Keyword3'])
  ->setTemplate( 'basic' )
  ->addComponent(
    Presshub\Template\Component::create()
      ->setMap('category')
      ->setValue('Test Category')
      ->setProps()
  )
  ->addComponent(
    Presshub\Template\Component::create()
      ->setMap('byline')
      ->setValue('By Author Name')
      ->setProps()
  )
  ->addComponent(
    Presshub\Template\Component::create()
      ->setMap('featured_image')
      ->setValue('URL')
      ->setProps([
        'Caption'      => 'Image caption',
        'Photographer' => 'Photo by Name',
      ])
  )
  ->addComponent(
    Presshub\Template\Component::create()
      ->setMap('body')
      ->setValue('<p>HTML content</p>')
      ->setProps()
  );

// Initialize Presshub Client object.
$client = new Presshub\Client('YOUR_PRESSHUB_API_KEY');

// Create local AMP version of your article.
$result = $client->setTemplate($template)
  ->setServices([
      'GoogleAmp' => [
        // Original content ID.
        'content_id' => 1,
        // Please make sure you change this value. Also make sure it is the same
        // in the `amp-webhook.php` file.
        'signature'  => 'sig_5842289f00001',
      ],
  ])
  ->publish()
  ->execute();

var_dump($result);
