#!/bin/bash

php artisan serve &
php artisan queue:work --queue=high,low