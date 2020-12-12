# Supermarket Checkout

## Find the problem Statement in the docs folder

```/docs/Programming exercise PHP – supermarket checkout.pdf```

## Install Composer Packages

```composer i```

## Running PHP Unit Tests (Still Adding More tests)

```php bin/phpunit tests/  --testdox```

## To see the test coverage (xdebug must be enabled before)
```bin/phpunit --coverage-text```

## To start the Server

```symfony server:start```

NOTE: If you dont have symfony command already, to Install it
``` curl -sS https://get.symfony.com/cli/installer | bash```

Refer: https://symfony.com/download

## To view the price calculation

```http://127.0.0.1:8000/checkout/review```

## To test the code by changing number of items

```src/Controller/ItemController.php```

In the above path change the number of items in the constant

```
const NO_OF_ITEMS_A = 7;
const NO_OF_ITEMS_B = 4;
const NO_OF_ITEMS_C = 7;
const NO_OF_ITEMS_D = 8;
const NO_OF_ITEMS_E = 5;
```

And refresh the page checkout/review to see new results.
