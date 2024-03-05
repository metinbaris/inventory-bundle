<?php

namespace MetinBaris\InventoryBundle\Service;

use MetinBaris\InventoryBundle\Entity\Stocks;
use Doctrine\ORM\EntityManagerInterface;
use MetinBaris\InventoryBundle\Message\InventoryOutOfStockMessage;
use Symfony\Component\Messenger\MessageBusInterface;

class InventoryProcessor
{
    private $entityManager;
    private $bus;

    public function __construct(EntityManagerInterface $entityManager, MessageBusInterface $bus)
    {
        $this->entityManager = $entityManager;
        $this->bus = $bus;
    }

    public function processStock(Stocks $stock)
    {
        $previousQuantity = $this->entityManager->getUnitOfWork()->getOriginalEntityData($stock)['quantity'] ?? null;

        if ($previousQuantity > 0 && $stock->getQuantity() === 0) {
            $this->dispatchOutOfStockMessage($stock);
        }
    }

    private function dispatchOutOfStockMessage(Stocks $stock)
    {
        $this->bus->dispatch(new InventoryOutOfStockMessage($stock));
    }
}
