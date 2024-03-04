# inventory-bundle
Symfony bundle for inventory updates


In the doctrine.yaml configuration file, under the orm section's mappings, synchronize your Symfony app name and alias for updating the database. For example, if your Symfony app is named 'App' and you have added bundle entities, ensure consistency between the app name and alias.

```
    doctrine:
      orm:
        auto_generate_proxy_classes: true
        enable_lazy_ghost_objects: true
        report_fields_where_declared: true
        validate_xml_mapping: true
        naming_strategy: doctrine.orm.naming_strategy.underscore_number_aware
        auto_mapping: true
        mappings:
          App:
            type: attribute
            is_bundle: false
            dir: '%kernel.project_dir%/src/Entity'
            prefix: 'App\Entity'
            alias: App
          MetinBaris\InventoryBundle:
            type: attribute
            dir: '%kernel.project_dir%/src/Entity'
            is_bundle: false
            prefix: App\Entity
            alias: App
```

Next add this line to your services.yaml file under services:

```
    MetinBaris\InventoryBundle\Command\ReadInventoryCommand:
        tags: ['console.command']
```