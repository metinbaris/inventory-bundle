<?php

namespace MetinBaris\InventoryBundle\MessageHandler;

use MetinBaris\InventoryBundle\Message\InventoryOutOfStockMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

#[AsMessageHandler]
class InventoryOutOfStockMessageHandler
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function __invoke(InventoryOutOfStockMessage $message)
    {
        $skock = $message->getStock();
        
        $email = (new Email())
            ->from($_ENV['INVENTORY_MAIL'])
            ->to($_ENV['INVENTORY_MAIL'])
            ->subject('Product Out of Stock')
            ->text("Product {$skock->getSku()} is now out of stock at a particular location.\nID: {$skock->getId()}");

        $this->mailer->send($email);
    }
}
