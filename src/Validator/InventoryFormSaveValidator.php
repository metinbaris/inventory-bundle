<?php

namespace MetinBaris\InventoryBundle\Validator;

class InventoryFormSaveValidator
{
    public function validate(string $sku, string $quantity): ?string
    {
        if (empty($sku)) {
            return 'SKU field is required';
        }

        if (!ctype_digit($quantity) && $quantity !== '0') {
            return 'Quantity should be a positive integer';
        }

        return null;
    }
}
