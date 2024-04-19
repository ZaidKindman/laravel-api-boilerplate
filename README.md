# Laravel API Boilerplate

This is a boilerplate for building RESTful APIs with PHP and the Laravel framework. It includes a number of features that make it easy to get started building APIs quickly and efficiently.

## Features

-   **Authentication and authorization**: The boilerplate includes support for JWT authentication and authorization using [Spatie](https://spatie.be/docs/laravel-permission/v6/installation-laravel) and [Laravel JWT Auth](https://laravel-jwt-auth.readthedocs.io/en/latest/).
-   **Response formatting**: The boilerplate includes support for formatting responses.
-   **Error handling**: The boilerplate includes a custom error handler that returns JSON API-compliant error responses.

## Requirements

-   PHP >= 8.2
-   Composer

## Getting started

To get started with the boilerplate, follow these steps:

1. Clone the repository:

```bash
git clone https://github.com/ZaidKindman/laravel-api-boilerplate.git
```

2. Install the dependencies:

```bash
cd laravel-api-boilerplate
composer install
```

3. Copy the example environment file and rename it to .env

4. Generate the application key:

```bash
php artisan key:generate
```

5. Create an sqlite database in database folder named: "database.sqlite".

6. Run the database migrations:

```bash
php artisan migrate:fresh --seed
```

7. Link the storage:

```bash
php artisan storage:link
```

8. Start the local development server:

```bash
php artisan serve
```
