# inventory-bundle
Symfony bundle for inventory updates

To install this bundle inside of your symfony project run
```
composer require metinbaris/inventory-bundle
```

Update your projects .env file, these should be included
```
INVENTORY_MAIL={email_address_to_share_stock_info}
MAILER_DSN={smtp://your_smtp_configuration}
DATABASE_URL={mysql_connection}
```

Create database table stocks
```
php bin/console doctrine:migrations:diff
php bin/console doctrine:migrations:migrate
```

Copy metin_baris_routes.yaml to your routes directory or copy paste this on your routes file
```
 metin_baris_inventory_bundle_routes:
    resource: '@InventoryBundle/Controller/'
    type: attribute
```

To upload csv, from your main symfony project root directory run
```
php bin/console metinbaris:read-inventory "{path_to_your_csv}/example.csv"
```

Be sure that Symfony Messenger worker is running for out of stock email for updates
```
php bin/console messenger:consume async
```

### List of stocks route:
/index

![alt text](https://github.com/metinbaris/inventory-bundle/blob/main/screenshot.png?raw=true)

# Project Dependencies

Ensure your environment has PHP `>=8.2` and the following PHP extensions and Composer packages installed:

- PHP version: `>=8.2`
- `ext-ctype`
- `ext-iconv`
- `doctrine/dbal`: `^3`
- `doctrine/doctrine-bundle`: `^2.11`
- `doctrine/doctrine-migrations-bundle`: `^3.3`
- `doctrine/orm`: `^3.1`
- `phpdocumentor/reflection-docblock`: `^5.3`
- `phpstan/phpdoc-parser`: `^1.26`
- `symfony/asset`: `7.0.*`
- `symfony/asset-mapper`: `7.0.*`
- `symfony/console`: `7.0.*`
- `symfony/doctrine-messenger`: `7.0.*`
- `symfony/dotenv`: `7.0.*`
- `symfony/expression-language`: `7.0.*`
- `symfony/flex`: `^2`
- `symfony/form`: `7.0.*`
- `symfony/framework-bundle`: `7.0.*`
- `symfony/http-client`: `7.0.*`
- `symfony/intl`: `7.0.*`
- `symfony/mailer`: `7.0.*`
- `symfony/mime`: `7.0.*`
- `symfony/monolog-bundle`: `^3.0`
- `symfony/notifier`: `7.0.*`
- `symfony/process`: `7.0.*`
- `symfony/property-access`: `7.0.*`
- `symfony/property-info`: `7.0.*`
- `symfony/runtime`: `7.0.*`
- `symfony/security-bundle`: `7.0.*`
- `symfony/serializer`: `7.0.*`
- `symfony/stimulus-bundle`: `^2.16`
- `symfony/string`: `7.0.*`
- `symfony/translation`: `7.0.*`
- `symfony/twig-bundle`: `7.0.*`
- `symfony/ux-turbo`: `^2.16`
- `symfony/validator`: `7.0.*`
- `symfony/web-link`: `7.0.*`
- `symfony/yaml`: `7.0.*`
- `twig/extra-bundle`: `^2.12|^3.0`
- `twig/twig`: `^2.12|^3.0`