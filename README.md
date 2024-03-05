# inventory-bundle
Symfony bundle for inventory updates

- Update your projects .env file, these should be included
```
INVENTORY_MAIL={email_address_to_share_stock_info}
MAILER_DSN={smtp://your_smtp_configuration}
DATABASE_URL={mysql_connection}
```

- Copy metin_baris_routes.yaml to your routes directory or copy paste this on your routes file
```
 metin_baris_inventory_bundle_routes:
    resource: '@InventoryBundle/Controller/'
    type: attribute
```

- To upload csv, from your main symfony project root directory run
```
php bin/console metinbaris:read-inventory "{path_to_your_csv}/example.csv"
```