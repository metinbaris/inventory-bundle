<?php

namespace MetinBaris\InventoryBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use MetinBaris\InventoryBundle\Entity\Stocks;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InventoryController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/index', 'index_route')]
    public function index(): Response
    {
        $stocks = $this->entityManager->getRepository(Stocks::class)->findAll();

        return $this->render('@Inventory/InventoryController/index.html.twig', [
            'stocks' => $stocks,
        ]);
    }
}
