# Simple user web service

A simple user web service built on Laravel Lumen.

Setup
-----------
#### Install vendor dependencies with Composer
Navigate to service's root directory:
```bash
cd user/
```

To install all composer dependencies, run the following command:
```bash
docker run --rm -v $(PWD):/app -v $($HOME)/.composer:/composer --user $(id -u):$(id -g) composer install --optimize-autoloader --no-interaction --no-progress --no-scripts
```


Data
-----------
It holds 3 users hardcoded in the `UserController`:
```php
    [
        "1" => "User 1",
        "2" => "User 2",
        "3" => "User 3",
    ]
```

Endpoints
-----------
There are 2 endpoints which are returning JSON Responses.

```
   # Returns all users
   GET http://user.laravel-microservices-example.local/user 
   
   # Returns spesific user by id
   # or returns 404 'User not found'
   # if user does not exist
   GET http://user.laravel-microservices-example.local/user/{id}
```