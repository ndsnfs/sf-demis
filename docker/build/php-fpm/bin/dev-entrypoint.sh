#!/bin/sh

bash -c "\
    composer install --prefer-dist --ignore-platform-reqs \
    && bin/console doctrine:migrations:migrate --no-interaction\
"

php-fpm
