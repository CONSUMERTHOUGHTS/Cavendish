# Cavendish Web Directory

Cavendish Web Directory is a proof-of-concept Restful API built using Laravel. It functions as a web directory where various websites are listed, categorized, and ranked based on user actions.



## Table of Contents
- [Summary](#summary)
- [Setup Instructions](#setup-instructions)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
- [Additional Plugins](#additional-plugins)
- [File Structure](#file-structure)
- [Usage Instructions](#usage-instructions)
  - [Authentication](#authentication)
  - [Website Management](#website-management)
  - [Voting](#voting)
  - [Admin Actions](#admin-actions)
- [Testing](#testing)
  - [Running Tests](#running-tests)
  - [Types of Tests](#types-of-tests)
  - [Example Test Commands](#example-test-commands)
- [Plugins](#plugins)
  - [Laravel Sanctum](#laravel-sanctum)
  - [Laravel Dusk](#laravel-dusk)
  - [PHP CodeSniffer](#php-codesniffer)
  - [Psalm](#psalm)
  - [PHPUnit](#phpunit)
- [Environment Configuration](#environment-configuration)
  - [.env.example](#envexample)
  - [.env.dusk.local](#envdusklocal)
  - [.env.testing](#envtesting)
- [Configuration Files](#configuration-files)
  - [phpcs.xml](#phpcsxml)
  - [phpstan.neon](#phpstanneon)
  - [phpunit.dusk.xml](#phpunitduskxml)
  - [phpunit.xml](#phpunitxml)
- [Setup Scripts](#setup-scripts)
  - [setup.sh for Linux](#setupsh-for-linux)
  - [setup.bat for Windows](#setupbat-for-windows)
- [Conclusion](#conclusion)

## Summary

Cavendish Web Directory provides a categorized listing of websites, allowing users to submit and vote on their favorite websites. The application supports three tiers of access:
- **Unauthenticated Users:** Can view and search websites.
- **Authenticated Users:** Can log in, submit websites, and vote on websites.
- **Administrators:** Can delete websites.

## Test-Driven Development (TDD) in the App

In this application, Test-Driven Development (TDD) has been employed to ensure code quality and reliability. TDD is a software development process where tests are written before the actual code is implemented. The main steps of TDD followed in this project are:

1. **Write a Test**: Before writing any functionality, a test is written to define what the code should do.
2. **Run the Test**: Initially, the test will fail because the functionality is not yet implemented.
3. **Write the Code**: Implement the minimum amount of code required to pass the test.
4. **Run the Test Again**: Ensure the test passes with the newly written code.
5. **Refactor**: Clean up the code while ensuring the tests still pass.

The following types of tests have been implemented:

- **Unit Tests**: Testing individual units of code, such as methods in a service class, to ensure they work as expected.
- **Feature Tests**: Testing the interactions between different parts of the application, such as API endpoints, to ensure they function correctly.
- **Browser Tests**: Using Laravel Dusk to simulate user interactions with the application through a browser.

By following TDD, we ensure that the application is well-tested, reliable, and maintainable.

## Efficiency

Efficiency in database operations is crucial for the performance of the application. The following considerations have been made in the database migrations to ensure structure, indexing, and optimizations:

1. **Table Structure**: The tables are designed with appropriate data types and relationships. For example, pivot tables are used for many-to-many relationships between websites and categories.
2. **Indexing**: Indexes are added to columns that are frequently searched or used in join operations. This improves query performance significantly.
3. **Optimized Queries**: Queries are written to minimize the load on the database. For example, eager loading is used to reduce the number of queries executed.

These optimizations ensure that the application runs efficiently, even with large datasets.

## Scalability

The application is designed to be scalable, ensuring that it performs well under heavy load and with large amounts of data. The following measures have been taken:

1. **Efficient Search**: The search functionality is optimized to handle millions of rows efficiently. Indexes are used on searchable fields, and queries are optimized for performance.
2. **Load Testing**: The application has been tested with large datasets to ensure that performance remains acceptable. Queries and endpoints are optimized to handle heavy traffic.
3. **Caching**: Where appropriate, caching mechanisms are used to reduce the load on the database and improve response times.

These measures ensure that the application remains responsive and performs well, even as the number of users and amount of data grow.


Cavendish Web Directory is a proof-of-concept Restful API built using Laravel. It functions as a web directory where various websites are listed, categorized, and ranked based on user actions.





## Setup Instructions



### Prerequisites



- PHP 8.2 or higher

- Composer

- Laravel 11.x

- XAMPP or another local server setup



### Installation



1. **Download the repository:**

   Download the `.zip` file or `.bundle` from the shared location and extract it.

   ```bash

   unzip cavendish-web-directory.zip

   cd cavendish-web-directory

    Install dependencies:

    bash
    Always show details

composer install

Set up environment variables:

    Copy the .env.example file to .env:

    bash
    Always show details

cp .env.example .env

cp .env.example .env.testing

cp .env.example .env.dusk.local

Generate an application key:

bash
Always show details

    php artisan key:generate

Set up the database:

    Configure your database settings in the .env file.
    Create SQLite database files:

    bash
    Always show details

touch database/database.sqlite

touch database/testing-database.sqlite

touch database/dusk-database.sqlite

Run the migrations and seed the database:

bash
Always show details

    php artisan migrate --seed

Install Dusk for browser testing (optional):

bash
Always show details

php artisan dusk:install

Run the application:

bash
Always show details

    php artisan serve



Additional Plugins

The application uses the following plugins to enhance functionality:

    Laravel Sanctum: For API token authentication.
    Laravel Dusk: For browser testing.
    PHP CodeSniffer: For code quality checks.
    Psalm: For static analysis.
    PHPUnit: For unit and feature testing.

To install these plugins, run:

bash
Always show details

composer require --dev laravel/sanctum laravel/dusk squizlabs/php_codesniffer vimeo/psalm phpunit/phpunit

File Structure

graphql
Always show details

cavendish-web-directory

├── app

│   ├── Console

│   ├── Exceptions

│   ├── Http

│   │   ├── Controllers

│   │   │   ├── AdminController.php       # Controller for admin actions

│   │   │   ├── AuthController.php        # Controller for authentication actions

│   │   │   └── WebsiteController.php     # Controller for website-related actions

│   │   ├── Middleware

│   │   └── Requests

│   ├── Models

│   │   ├── Category.php                  # Model for Category

│   │   ├── User.php                      # Model for User

│   │   ├── Vote.php                      # Model for Vote

│   │   └── Website.php                   # Model for Website

│   └── Providers

├── bootstrap

├── config

├── database

│   ├── factories

│   ├── migrations

│   │   ├── create_categories_table.php   # Migration for categories table

│   │   ├── create_users_table.php        # Migration for users table

│   │   ├── create_votes_table.php        # Migration for votes table

│   │   └── create_websites_table.php     # Migration for websites table

│   ├── seeders

│   │   ├── CategorySeeder.php            # Seeder for categories

│   │   ├── DatabaseSeeder.php            # Main seeder file

│   │   └── WebsiteSeeder.php             # Seeder for websites

├── public

├── resources

├── routes

│   ├── api.php                           # API routes

│   └── web.php                           # Web routes

├── tests

│   ├── Browser

│   │   └── ExampleTest.php               # Dusk browser test example

│   ├── Feature

│   │   ├── AdminTest.php                 # Feature test for admin actions

│   │   ├── CategoryTest.php              # Feature test for category actions

│   │   ├── ExampleTest.php               # Feature test example

│   │   ├── VoteTest.php                  # Feature test for voting actions

│   │   └── WebsiteTest.php               # Feature test for website actions

│   ├── Unit

│   │   ├── ExampleTest.php               # Unit test example

│   │   └── MathServiceTest.php           # Unit test for MathService

│   ├── CreatesApplication.php            # Trait to create application for tests

│   ├── DuskTestCase.php                  # Base test case for Dusk

│   └── TestCase.php                      # Base test case for PHPUnit

├── .env                                  # Environment configuration file

├── .env.dusk.local                       # Environment configuration file for Dusk

├── .env.testing                          # Environment configuration file for testing

├── artisan                               # Artisan command-line tool

├── composer.json                         # Composer dependencies file

├── composer.lock                         # Composer lock file

├── phpunit.xml                           # PHPUnit configuration file

├── phpstan.neon                          # PHPStan configuration file

├── phpcs.xml                             # PHP CodeSniffer configuration file

├── phpunit.dusk.xml                      # PHPUnit Dusk configuration file

└── README.md                             # This file

### Usage Instructions
# Authentication

    Register: POST /api/register
    Login: POST /api/login
    Logout: POST /api/logout

# Website Management

    Submit a Website: POST /api/websites (Authenticated)
    View Websites by Category: GET /api/websites
    Search Websites: GET /api/websites/search?query={searchTerm}

# Voting

    Vote for a Website: POST /api/websites/{id}/vote (Authenticated)
    Unvote a Website: DELETE /api/websites/{id}/vote (Authenticated)

# Admin Actions

    Delete a Website: DELETE /api/websites/{id} (Admin)
    
## Example Usage Instructions
# Authentication

To interact with the API as an authenticated user, you need to register and log in. Use the following endpoints for authentication:
Register

Endpoint: POST /api/register

# Request Body:

json

{
    "name": "Your Name",
    "email": "your.email@example.com",
    "password": "yourpassword",
    "password_confirmation": "yourpassword"
}

# Response:

json

{
    "message": "User registered successfully",
    "user": {
        "id": 1,
        "name": "Your Name",
        "email": "your.email@example.com",
        "created_at": "2024-07-22T00:00:00.000000Z",
        "updated_at": "2024-07-22T00:00:00.000000Z"
    }
}

# Login

Endpoint: POST /api/login

Request Body:

json

{
    "email": "your.email@example.com",
    "password": "yourpassword"
}

Response:

json

{
    "token": "your-access-token"
}

# Logout

Endpoint: POST /api/logout

Headers:

http

Authorization: Bearer your-access-token

Response:

json

{
    "message": "User logged out successfully"
}

# Website Management

Authenticated users can submit their favorite websites to the directory.
Submit a Website

Endpoint: POST /api/websites

Headers:

http

Authorization: Bearer your-access-token

Request Body:

json

{
    "title": "Website Title",
    "url": "https://www.example.com",
    "categories": [1, 2]  // Array of category IDs
}

Response:

json

{
    "message": "Website submitted successfully",
    "website": {
        "id": 1,
        "title": "Website Title",
        "url": "https://www.example.com",
        "created_at": "2024-07-22T00:00:00.000000Z",
        "updated_at": "2024-07-22T00:00:00.000000Z"
    }
}

# View Websites by Category

Endpoint: GET /api/websites

Response:

json

[
    {
        "id": 1,
        "title": "Website Title",
        "url": "https://www.example.com",
        "votes": 10,
        "categories": [
            {
                "id": 1,
                "name": "Category Name"
            }
        ]
    }
]

# Search Websites

Endpoint: GET /api/websites/search

Query Parameters:

    query: The search term.

Response:

json

[
    {
        "id": 1,
        "title": "Website Title",
        "url": "https://www.example.com",
        "votes": 10,
        "categories": [
            {
                "id": 1,
                "name": "Category Name"
            }
        ]
    }
]

# Voting

Authenticated users can vote and unvote websites.
Vote for a Website

Endpoint: POST /api/websites/{id}/vote

Headers:

http

Authorization: Bearer your-access-token

Response:

json

{
    "message": "Voted successfully",
    "votes": 11
}

# Unvote a Website

Endpoint: DELETE /api/websites/{id}/vote

Headers:

http

Authorization: Bearer your-access-token

Response:

json

{
    "message": "Unvoted successfully",
    "votes": 10
}

# Admin Actions

Administrators can delete websites from the directory.
Delete a Website

Endpoint: DELETE /api/websites/{id}

Headers:

http

Authorization: Bearer your-access-token

Response:

json

{
    "message": "Website deleted successfully"
}


### Testing
Running Tests

To run all tests (unit, feature, and browser tests), use the following commands:
Unit and Feature Tests:

bash
Always show details

php artisan test

Browser Tests (Dusk):

bash
Always show details

php artisan dusk

Types of Tests

    Unit Tests: Located in tests/Unit, these tests cover individual units of code, such as methods in a service class.
    Feature Tests: Located in tests/Feature, these tests cover the interactions between different parts of the application, such as API endpoints.
    Browser Tests: Located in tests/Browser, these tests simulate user interactions with the application using a browser.

Example Test Commands

To run a specific unit test:

bash
Always show details

php artisan test --filter=ExampleTest

To run a specific feature test:

bash
Always show details

php artisan test --filter=AdminTest




## Plugins
### Laravel Sanctum

Sanctum provides a featherweight authentication system for SPAs (single page applications), mobile applications, and simple, token-based APIs. To use Sanctum:

#### Install Sanctum:

   ```bash
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\\Sanctum\\SanctumServiceProvider"
php artisan migrate

Add Sanctum's middleware:

In app/Http/Kernel.php:

## php
Always show details

'api' => [
    \\Laravel\\Sanctum\\Http\\Middleware\\EnsureFrontendRequestsAreStateful::class,
    'throttle:api',
    \\Illuminate\\Routing\\Middleware\\SubstituteBindings::class,
],

### Laravel Dusk

Dusk provides an expressive, easy-to-use browser automation and testing API. To use Dusk:
Install Dusk:

bash
Always show details

php artisan dusk:install

Running Dusk tests:

bash
Always show details

php artisan dusk

### PHP CodeSniffer

PHP CodeSniffer detects violations of a defined coding standard. To use PHP CodeSniffer:
Install PHP CodeSniffer:

   ```bash
Always show details

composer require --dev squizlabs/php_codesniffer

Run PHP CodeSniffer:

   ```bash
Always show details

vendor/bin/phpcs

### Psalm

Psalm is a static analysis tool for finding errors in PHP applications. To use Psalm:
Install Psalm:

bash
Always show details

composer require --dev vimeo/psalm

Run Psalm:

   ```bash
Always show details

vendor/bin/psalm

### PHPUnit

PHPUnit is a programmer-oriented testing framework for PHP. To use PHPUnit:
Run PHPUnit tests:

   ```bash
Always show details

php artisan test

### Environment Configuration
.env.example

dotenv
Always show details

APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:YOUR_APP_KEY
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=sqlite
DB_DATABASE=/path/to/database.sqlite

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

.env.dusk.local

dotenv
Always show details

APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:YOUR_APP_KEY
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=sqlite
DB_DATABASE=/path/to/dusk-database.sqlite

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

.env.testing

dotenv
Always show details

APP_NAME=Laravel
APP_ENV=testing
APP_KEY=base64:YOUR_APP_KEY
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=sqlite
DB_DATABASE=/path/to/testing-database.sqlite

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

Configuration Files
phpcs.xml

xml
Always show details

<?xml version="1.0"?>
<ruleset name="Cavendish Web Directory">
    <description>Coding standards for Cavendish Web Directory project</description>
    <rule ref="PSR2"/>
    <arg name="basepath" value="."/>
    <file>.</file>
    <exclude-pattern>vendor/*</exclude-pattern>
</ruleset>

phpstan.neon

neon
Always show details

parameters:
    level: max
    paths:
        - app
        - tests
    excludePaths:
        - vendor
    autoload_files:
        - bootstrap/autoload.php
    ignoreErrors:
        - '#Unsafe usage of new static#'

phpunit.dusk.xml

xml
Always show details

<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:noNamespaceSchemaLocation="vendor/phpunit/phpunit/phpunit.xsd"
         bootstrap="tests/DuskTestCase.php"
         colors="true"
         stopOnFailure="false"
         backupGlobals="false">
    <testsuites>
        <testsuite name="Browser">
            <directory>./tests/Browser</directory>
        </testsuite>
    </testsuites>
</phpunit>

phpunit.xml

xml
Always show details

<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:noNamespaceSchemaLocation="vendor/phpunit/phpunit/phpunit.xsd"
         bootstrap="vendor/autoload.php"
         colors="true">
    <testsuites>
        <testsuite name="Unit">
            <directory>./tests/Unit</directory>
        </testsuite>
        <testsuite name="Feature">
            <directory>./tests/Feature</directory>
        </testsuite>
    </testsuites>
    <php>
        <env name="APP_ENV" value="testing"/>
        <env name="CACHE_DRIVER" value="array"/>
        <env name="SESSION_DRIVER" value="array"/>
        <env name="QUEUE_CONNECTION" value="sync"/>
        <env name="MAIL_MAILER" value="array"/>
    </php>
</phpunit>

Setup Scripts
setup.sh for Linux

bash
Always show details

#!/bin/bash

# Install dependencies
composer install

# Set up environment files
cp .env.example .env
cp .env.example .env.testing
cp .env.example .env.dusk.local

# Generate application key
php artisan key:generate

# Set up the database
touch database/database.sqlite
touch database/testing-database.sqlite
touch database/dusk-database.sqlite
php artisan migrate --seed

# Install Laravel Dusk
php artisan dusk:install

# Run tests
php artisan test
php artisan dusk

setup.bat for Windows

bat
Always show details

@echo off

:: Install dependencies
composer install

:: Set up environment files
copy .env.example .env
copy .env.example .env.testing
copy .env.example .env.dusk.local

:: Generate application key
php artisan key:generate

:: Set up the database
type NUL > database\database.sqlite
type NUL > database\testing-database.sqlite
type NUL > database\dusk-database.sqlite
php artisan migrate --seed

:: Install Laravel Dusk
php artisan dusk:install

:: Run tests
php artisan test
php artisan dusk

Conclusion

This guide should provide a comprehensive overview of the Cavendish Web Directory application, including setup, usage, testing, and plugins. If you encounter any issues or need further assistance, feel free to reach out. 