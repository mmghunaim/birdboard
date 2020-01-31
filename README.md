# Biradboard [![Build Status](https://travis-ci.com/mmghunaim/birdboard.svg?branch=master)](https://travis-ci.com/mmghunaim/birdboard)

This is an open source project build by me with following Jeffrey Way

## Installation

### Step 1.

> To run this project, you must have PHP 7 installed as a prerequisite.

Begin by cloning this repository to your drive

```php
git clone https://github.com/mmghunaim/birdboard.git
```
### Step 2
Go to the project directory
```xpath
cd birdboard
```
### Step 3
Installing all Composer dependencies.
```
composer install
mv .env.example .env
php artisan key:generate
```

### Step 4

Next, create a new database and reference its name and username/password within the project's '.env' file. In the example below, we've named the database "birdboard".
```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=birdboard
DB_USERNAME=root
DB_PASSWORD=
```
### Step 5
Migrate database's tables.
```php
php artisan migrate
```
### Step 6
Once finished, clear your server cache, and you're all set to go!
```$xslt
php artisan cache:clear
```

