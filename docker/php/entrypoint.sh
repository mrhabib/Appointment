#!/bin/sh

# Ensure all services are up by waiting a few seconds
sleep 10

# Run the PHP commands
composer install
php -f web/core/init.php

# Execute the original command
exec "$@"

