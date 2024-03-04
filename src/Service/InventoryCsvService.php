<?php

namespace MetinBaris\InventoryBundle\Service;

use MetinBaris\InventoryBundle\Validator\InventoryCsvFileValidator;
use MetinBaris\InventoryBundle\Entity\Stocks;
use Doctrine\ORM\EntityManagerInterface;

class InventoryCsvService
{
    private $csvFileValidator;
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->csvFileValidator = new InventoryCsvFileValidator();
        $this->entityManager = $entityManager;
    }

    public function update(string $filePath): bool
    {
        $validation = $this->csvFileValidator->validate($filePath);

        if (!empty($validation)) {
            throw new \Exception($validation);
        }

        $csv = fopen($filePath, 'r');
        $headers = fgetcsv($csv);
        while ($row = fgetcsv($csv)) {
            $data = array_combine($headers, $row);
            $id = $data['id'];
            $sku = $data['sku'];
            $quantity = $data['quantity'];

            $product = $this->entityManager->getRepository(Stocks::class)->find($id);
            if (!$product) {
                $product = new Stocks();
                $product->setId($id);
            }

            $product->setSku($sku);
            $product->setQuantity($quantity);

            $this->entityManager->persist($product);
        }

        fclose($csv);
        $this->entityManager->flush();

        return true;
    }
}
