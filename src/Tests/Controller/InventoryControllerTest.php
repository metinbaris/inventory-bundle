<?php

namespace MetinBaris\InventoryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use \MetinBaris\InventoryBundle\Entity\Stocks;

class InventoryControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/index');

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(200);
    }

    public function testSave()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/save-product',
            [
                'sku' => 'ABC123',
                'quantity' => 10,
            ]
        );
        $this->assertResponseRedirects('/index');
        $client->followRedirect();
        $this->assertSelectorTextContains('ins', 'Product');

        // Database record testing
        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');
        $stockRepository = $entityManager->getRepository(Stocks::class);
        $stock = $stockRepository->findOneBy(['sku' => 'ABC123']);
        $this->assertNotNull($stock);

        $this->assertEquals('ABC123', $stock->getSku());
        $this->assertEquals(10, $stock->getQuantity());
    }

    public function testSaveSKURequired()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/save-product',
            [
                'sku' => '',
                'quantity' => 10,
            ]
        );
        $this->assertResponseRedirects('/index');
        $client->followRedirect();
        $this->assertSelectorTextSame('ins', 'SKU field is required');
    }

    public function testSaveQuantityWrong()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/save-product',
            [
                'sku' => 'ProductABC',
                'quantity' => -5,
            ]
        );
        $this->assertResponseRedirects('/index');
        $client->followRedirect();
        $this->assertSelectorTextSame('ins', 'Quantity should be a positive integer');
    }
}
