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

// Publish article to AppleNews and Twitter.
// More can be added. See Get Services callback.
$result = $client->setTemplate($template)
  ->setServices([
      'AppleNews' => [],
      'Twitter'   => [
        "message" => "This is how you could override the title",
        // Specify images - up to 5 supported.
        "media"   => [
          "https://images.unsplash.com/photo-1451153378752-16ef2b36ad05?dpr=1&auto=format&fit=crop&w=1500&h=1004&q=80&cs=tinysrgb&crop=",
          "https://images.unsplash.com/photo-1480129043491-6d5a4785b65c?dpr=1&auto=format&fit=crop&w=1500&h=1280&q=80&cs=tinysrgb&crop="
        ],
      ]
  ])
  ->publish()
  ->execute();

var_dump($result);
