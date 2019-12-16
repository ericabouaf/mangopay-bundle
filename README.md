MangoPay Bundle for Symfony [![Build Status](https://travis-ci.org/neyric/mangopay-bundle.svg?branch=master)](https://travis-ci.org/neyric/mangopay-bundle) [![Latest Stable Version](https://poser.pugx.org/neyric/mangopay-bundle/v/stable)](https://packagist.org/packages/neyric/mangopay-bundle) [![Total Downloads](https://poser.pugx.org/neyric/mangopay-bundle/downloads)](https://packagist.org/packages/neyric/mangopay-bundle) [![License](https://poser.pugx.org/neyric/mangopay-bundle/license)](https://packagist.org/packages/neyric/mangopay-bundle)
=================================================

A Symfony bundle for [MangoPay](https://www.mangopay.com/), providing additionnal services on top of the official [MangoPay PHP SDK](https://github.com/Mangopay/mangopay2-php-sdk)

* Provide a service to access the API for a better Symfony integration
* Add useful commands
* Webhook handler (HTTP controller) + Webhook Event

## Requirements

* Php 7.1
* Symfony 4.4

## Installation

```console
$ composer require neyric/mangopay-bundle
```

Load the bundle in your app

```php
$bundles = [
    // ...
    new \Neyric\MangoPayBundle\NeyricMangoPayBundle(),
];
```

## Configuration

The bundle (in particular the MangoPayService), expects those 3 environement variables to be defined

* MANGOPAY_CLIENT_ID
* MANGOPAY_PASSWORD
* MANGOPAY_BASE_URL (should be https://api.sandbox.mangopay.com or https://api.mangopay.com)


## Commands

Display a list of installed hooks :

```sh
php bin/console neyric_mangopay:hooks:list
```

Display rate limits (performs 1 api call) :

```sh
php bin/console neyric_mangopay:ratelimits
```


## Using the webhook handler

First, setup the route in your routes.yaml file :

```yaml
neyric_mangopay:
    path: /mangopay_webook/hook_handler # Customizable url
    controller: Neyric\MangoPayBundle\Controller\HookController::hookHandlerAction
```

The register the webhook, you want using the Mangopay console.

Create a subscriber

```php
use Neyric\MangoPayBundle\Event\MangoPayHookEvent;

class MySubscriber implements EventSubscriberInterface
{
    
    public function onMangopayKycSucceeded(MangoPayHookEvent $event)
    {
        // ...
    }

    public function onMangopayUboDeclarationValidated(MangoPayHookEvent $event)
    {
        // ...
    }

    public static function getSubscribedEvents()
    {
        return [
            'MANGOPAY_KYC_SUCCEEDED' => ['onMangopayKycSucceeded', 1],
            'MANGOPAY_UBO_DECLARATION_VALIDATED' => ['onMangopayUboDeclarationValidated', 1],
        ];
    }
}
```

And eventually declare the service with the  `kernel.event_subscriber` tag :

```yaml
    App\Subscriber\MySubscriber:
        class: App\Subscriber\MySubscriber
        tags:
            - { name: kernel.event_subscriber }
```


License
-------------------------------------------------
neyric/mangopay-bundle is distributed under MIT license, see the [LICENSE file](https://github.com/neyric/mangopay-bundle/blob/master/LICENSE).


Contacts
-------------------------------------------------
Report bugs or suggest features using [issue tracker on GitHub](https://github.com/neyric/mangopay-bundle).