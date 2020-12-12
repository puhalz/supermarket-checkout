# Supermarket Checkout
Supermarket

## Install Composer Packages

```composer i```

## Running PHP Unit Tests (Still Adding More tests)

```php bin/phpunit tests/```

## To view the price calculation

```http://127.0.0.1:8000/checkout/review```

## To test the code by changing no of items

```src/Controller/ItemController.php```

In the above path change the number of items in the constant

```    const NO_OF_ITEMS_A = 7;
       const NO_OF_ITEMS_B = 4;
       const NO_OF_ITEMS_C = 7;
       const NO_OF_ITEMS_D = 8;
       const NO_OF_ITEMS_E = 5;
```

And refresh the page checkout/review to see new results.
