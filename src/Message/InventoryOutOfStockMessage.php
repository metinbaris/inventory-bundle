<?php
namespace MetinBaris\InventoryBundle\Message;

use MetinBaris\InventoryBundle\Entity\Stocks;

class InventoryOutOfStockMessage
{
    private $stock;

    public function __construct(Stocks $stock)
    {
        $this->stock = $stock;
    }

    public function getStock(): Stocks
    {
        return $this->stock;
    }
}
