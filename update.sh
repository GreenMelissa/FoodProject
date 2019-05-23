#!/usr/bin/env bash
composer install
php yii init
php yii migrate
php yii rbac/migrate
rm -rf frontend/web/assets/*