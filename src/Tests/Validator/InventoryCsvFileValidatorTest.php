<?php

use MetinBaris\InventoryBundle\Validator\InventoryCsvFileValidator;
use PHPUnit\Framework\TestCase;

class InventoryCsvFileValidatorTest extends TestCase
{
    private $validator;
    private $validFilePath;
    private $invalidFilePath;
    private $tempFiles = [];

    protected function setUp(): void
    {
        $this->validator = new InventoryCsvFileValidator();

        // Prepare a valid CSV file
        $this->validFilePath = __DIR__ . '/../../../example.csv';
        // Prepare an invalid CSV file path (no file)
        $this->invalidFilePath = '/path/to/non/existent/file.csv';
    }

    protected function tearDown(): void
    {
        // Cleanup temporary files
        foreach ($this->tempFiles as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }
    }

    public function testValidateWithNonExistentFile()
    {
        $result = $this->validator->validate($this->invalidFilePath);
        $this->assertEquals('Error: The specified file does not exist.', $result);
    }

    public function testValidateWithValidFile()
    {
        $result = $this->validator->validate($this->validFilePath);
        $this->assertNull($result, 'Expected null for a valid CSV file');
    }

    public function testValidateWithInvalidHeaders()
    {
        $invalidHeaderFilePath = $this->createTempFileWithContent("wrong,header,set\n1,ABC-123,10");
        $result = $this->validator->validate($invalidHeaderFilePath);
        $this->assertEquals('Error: Invalid CSV file headers.', $result);
    }

    public function testValidateWithInvalidRowData()
    {
        $invalidRowDataFilePath = $this->createTempFileWithContent("id,sku,quantity\none,ABC-123,ten");
        $result = $this->validator->validate($invalidRowDataFilePath);
        $this->assertEquals('Error: Invalid data types in the CSV file.', $result);
    }

    private function createTempFileWithContent(string $content): string
    {
        $tempFilePath = tempnam(sys_get_temp_dir(), 'csv_test_');
        file_put_contents($tempFilePath, $content);
        $this->tempFiles[] = $tempFilePath;
        return $tempFilePath;
    }
}
