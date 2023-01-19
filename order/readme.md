# Simple order web service

A simple order web service built on Laravel Lumen.

Setup
-----------
#### Install vendor dependencies with Composer
Navigate to service's root directory:
```bash
cd order/
```

To install all composer dependencies, run the following command:
```bash
docker run --rm -v $(PWD):/app -v $($HOME)/.composer:/composer --user $(id -u):$(id -g) composer install --optimize-autoloader --no-interaction --no-progress --no-scripts
```


Data
-----------
It holds 3 orders hardcoded in the `OrderController`:
```php
    [
        "1" => ["user" => "1", "products" => ["1", "2"]],
        "2" => ["user" => "1", "products" => ["3"] ],
        "3" => ["user" => "2", "products" => ["1", "3"]],
    ]
```

Endpoints
-----------
There are 3 endpoints which are returning JSON Responses.

```
   # Returns all orders
   GET http://order.laravel-microservices-example.local/order 
   
   # Returns spesific order by id
   # or returns 404 'Order not found'
   # if order does not exist
   GET http://order.laravel-microservices-example.local/order/{id}
   
   # Returns all orders of a spesific user
   # or returns 404 'No orders found for this user'
   GET http://order.laravel-microservices-example.local/order/user/{user}
```