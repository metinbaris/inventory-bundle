<?php

namespace MetinBaris\InventoryBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use MetinBaris\InventoryBundle\Entity\Stocks;
use MetinBaris\InventoryBundle\Service\InventoryProcessor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class InventoryController extends AbstractController
{
    private $entityManager;
    private $inventoryProcessor;
    public function __construct(EntityManagerInterface $entityManager, InventoryProcessor $inventoryProcessor)
    {
        $this->entityManager = $entityManager;
        $this->inventoryProcessor = $inventoryProcessor;
    }

    #[Route('/index', 'index_route')]
    public function index(): Response
    {
        $stocks = $this->entityManager->getRepository(Stocks::class)->findAll();

        return $this->render('@Inventory/InventoryController/index.html.twig', [
            'stocks' => $stocks,
        ]);
    }

    #[Route("/save-product", "save_product")]
    public function save(Request $request): Response
    {
        $sku = $request->request->get('sku');
        $quantity = $request->request->get('quantity');

        if ($request->isMethod('POST')) {

            $existingStock = $this->entityManager->getRepository(Stocks::class)->findOneBy(['sku' => $sku]);
            if ($existingStock) {
                $existingStock->setQuantity($quantity);
                $stock = $existingStock;
            } else {
                $stock = new Stocks();
                $stock->setSku($sku);
                $stock->setQuantity($quantity);
            }

            $this->entityManager->persist($stock);

            // Mail out of stock
            $this->inventoryProcessor->processStock($stock);

            $this->entityManager->flush();
            return $this->redirectToRoute('index_route');
        }

        return $this->render('@Inventory/InventoryController/save.html.twig');
    }
}
