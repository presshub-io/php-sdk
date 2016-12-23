# Presshub PHP SDK

`Presshub\Template` is a PHP library that helps construct templates in the [Presshub Template format](https://www.presshub.io/docs/v1/templates)

`Presshub\Client` is a PHP library that allows you to distribute content to third-party content platforms via Presshub API. You can also retrieve and delete articles you’ve already published, and get basic information about your published articles, information about supported services and more.

Presshub [API Reference](https://www.presshub.io/docs/)

## Installation

```shell
composer require presshub-io/php-sdk
```

or

```shell
git clone git@github.com:presshub-io/php-sdk.git
cd php-sdk
curl -sS https://getcomposer.org/installer | php
./composer.phar install
```

## Presshub Template
This example shows how to build Presshub template and map template fields.

```php
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

```

## Presshub Client

```php
$api_key_id = "YOUR_PRESSHUB_API_KEY";

// maximum amount of time in seconds to which the execution of individual
// cURL extension function calls will be limited. Note that the value 
// for this setting should include the value for $connect_timeout.
$timeout = 400;

// Maximum amount of time in seconds that is allowed to make the connection 
// to the server. It can be set to 0 to disable this limit, 
// but this is inadvisable in a production environment.
$connect_timeout = 0;

// Defaults to https://api.presshub.io/v1 However in some cases we create
// separate servers for premium clients.
$endpoint = "https://api.presshub.io/v1";

// Initialize Presshub Client object.
$client = new Presshub\Client($api_key, $timeout, $connect_timeout, $endpoint);
```

##### Preview Article

```php
// Generate previewable files, more services can be added.
// Please follow example: 'FacebookIA' => []
$result = $client->setTemplate($template)
  ->setServices([
      'AppleNews' => [],
      'Twitter'   => [
        // When empty article title will be used.
        "message" => "This is how you could override the title"
      ]
  ])
  ->preview()
  ->execute();

var_dump($result);
```

##### Publish Article

```php
// Publish article to AppleNews and Twitter.
// More can be added. See Get Services callback.
// $template - is a Presshub Template object. See above for an example.
$result = $client->setTemplate($template)
  ->setServices([
      'AppleNews' => [],
      'Twitter'   => [
        // When empty article title will be used.
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
```

##### Update Article

```php
// Update article in AppleNews and Twitter
// Please note not all services support update operation via API.
$result = $client->setTemplate($template)
  ->setServices([
      'AppleNews' => [],
      'Twitter'   => [
        // When empty article title will be used.
        "message" => "This is how you could override the title"
      ]
  ])
  // Presshub publication ID.
  ->update('POST_ID')
  ->execute();

var_dump($result);
```

##### Delete Article

```php
// Delete article from AppleNews and Twitter
// Please note not all services support delete operation via API.
$result = $client->setServices([
      'AppleNews' => [],
      'Twitter'   => []
  ])
  ->delete('POST_ID')
  ->execute();

var_dump($result);
```

See `examples` directory for more code examples.
