# Sample application

## Prerequisites

- PHP 7.2
- MariaDB/MySQL
- Composer installed on the machine

## DB config

Open your mysql database client and run database.sql (contains lines for creating the ce user, database and access rights + tables).

## Install dependencies

In the root of the project:

```
COMPOSER_PROCESS_TIMEOUT=360 composer install
```

## Run the server

Command to run the server (times out after 1h)

```
COMPOSER_PROCESS_TIMEOUT=3600 composer serve
```

Runs the server on: http://0.0.0.0:8080