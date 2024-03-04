<?php

namespace MetinBaris\InventoryBundle\Validator;

class InventoryCsvFileValidator
{
    public function validate(string $csvFilePath): ?string
    {
        $handle = $this->openFile($csvFilePath);
        if (!is_resource($handle)) {
            return $handle;
        }

        $valid = $this->checkValid($handle);

        return $valid;
    }

    private function openFile(string $csvFilePath)
    {
        // Check if the file exists
        if (!file_exists($csvFilePath)) {
            return 'Error: The specified file does not exist.';
        }

        // Check if the file is readable
        if (!is_readable($csvFilePath)) {
            return 'Error: Unable to read the file.';
        }

        // Open the file and read the first row (headers)
        $handle = fopen($csvFilePath, 'r');

        if ($handle === false) {
            return 'Error: Unable to open the file.';
        }

        return $handle;
    }

    private function checkValid($handle): ?string
    {
        $headers = fgetcsv($handle);

        // Check if the headers match the expected headers
        $expectedHeaders = ['id', 'sku', 'quantity'];
        if ($headers !== $expectedHeaders) {
            fclose($handle);
            return 'Error: Invalid CSV file headers.';
        }

        // Validate each row's data type
        while ($row = fgetcsv($handle)) {
            // Check if the row has the expected number of columns
            if (count($row) !== count($expectedHeaders)) {
                fclose($handle);
                return 'Error: Invalid number of columns in the CSV file.';
            }

            // Validate data types
            if (!is_numeric($row[0]) || !is_string($row[1]) || !is_numeric($row[2])) {
                fclose($handle);
                return 'Error: Invalid data types in the CSV file.';
            }
        }

        fclose($handle);

        return null;
    }
}
