<?php

/**
 * @file
 * Presshub article publish example.
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

// Publish article to AppleNews and Twitter.
// More can be added. See Get Services callback.
$result = $client->setTemplate($template)
  ->setServices([
      'AppleNews' => [],
      'Twitter'   => []
  ])
  ->publish()
  ->execute();

var_dump($result);
