# Biradboard

This is an open source project build by me with following Jeffrey Way

## Installation

### Step 1.

> To run this project, you must have PHP 7 installed as a prerequisite.

Begin by cloning this repository to your drive, and installing all Composer dependencies.

```bash
git clone https://github.com/mmghunaim/birdboard.git
cd birdboard && composer install
php artisan key:generate
mv .env.example .env
```

### Step 2

Next, create a new database and reference its name and username/password within the project's '.env' file. In the example below, we've named the database "birdboard".
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=birdboard
DB_USERNAME=root
DB_PASSWORD=
```

### Step 3
Once finished, clear your server cache, and you're all set to go!
```$xslt
php artisan cache:clear
```

