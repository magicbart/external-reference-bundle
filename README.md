# ExternalReferenceBundle

ExternalReferenceBundle is a Symfony bundle that provides a mechanism for storing and managing external references for objects created via external APIs. This bundle allows developers to keep track of relationships between local and external resources efficiently.

## Installation

Install the bundle using Composer:

```sh
composer require magicbart/external-reference-bundle
```

Then, enable the bundle in your Symfony application (if not done automatically):

```php
// config/bundles.php
return [
    Magicbart\ExternalReferenceBundle\MagicbartExternalReferenceBundle::class => ['all' => true],,
];
```

Run the necessary database migrations if the bundle provides a storage mechanism:

```sh
php bin/console doctrine:migrations:migrate
```

## Usage

### Register an External Reference

```php
use Magicbart\ExternalReferenceBundle\Manager\ExternalReferenceManager;

$referenceManager = $this->get(ExternalReferenceManager::class);
$referenceManager->add(User::class, $user->getId(), 'external_id', 'target');
```

### Retrieve an External Reference

```php
$externalReference = $referenceManager->get(User::class, $user->getId(), 'external_id', 'target');
```

## Contributing

Feel free to contribute by submitting issues or pull requests to improve the bundle.

## License

This bundle is licensed under the Apache License.

