# inventory-bundle
Symfony bundle for inventory updates

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