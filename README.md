# Sample application

## Prerequisites

- PHP 7.2
- MariaDB/MySQL
- Composer installed on the machine

## DB config

Open your mysql database client, create a datab ase `amazium` with username/password combo `amazium` / `amazium`. Import `amazium.sql` into the newly created schema.

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