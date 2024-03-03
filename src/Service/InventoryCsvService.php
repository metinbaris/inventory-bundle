<?php

namespace MetinBaris\InventoryBundle\Service;

use MetinBaris\InventoryBundle\Validator\InventoryCsvFileValidator;

class InventoryCsvService
{
    private $csvFileValidator;
    public function __construct()
    {
        $this->csvFileValidator = new InventoryCsvFileValidator();
    }

    public function update(string $filePath): bool
    {
        $isValid = $this->csvFileValidator->validate($filePath);
        if (!empty($isValid)) {
            throw new \Exception($isValid);
        }

        // TODO: ADD DB update

        return true;
    }
}