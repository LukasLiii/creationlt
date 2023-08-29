<?php

namespace App\Factory;

use App\Factory\FileHandlerInterface;
use Exception;

class XmlFileHandler implements FileHandlerInterface
{
    /** @var array<int,<array<string>>> $data */
    private array $data = [];

    /**
     * Reads xml file.
     *
     * @param array<string> $file Uploaded file data.
     * @return void
     * @throws Exception if file is empty.
     */
    public function readData(array $file): void
    {
        if (empty($file)) {
            throw new Exception('File is empty');
        }

        /* Check if file contains errors */
        if ($file['error'] === UPLOAD_ERR_OK) {
            $filePath = $file['tmp_name'];
            $xmlData = file_get_contents($filePath);
            $xml = simplexml_load_string($xmlData);
            $this->data = $xml ? json_decode(json_encode($xml), true) : [];
        }
    }

    /**
     * Decorates file data.
     *
     * @return array<int,<array<int|string>>> Transformed data.
     */
    public function decorateData(): array
    {
        $decoratedData = [];
        if (isset($this->data['item'])) {
            foreach ($this->data['item'] as $data) {
                $decoratedData[] = array_filter([
                    'First name' => $data['first_name'] ?? '',
                    'age' => (int) ($data['age'] ?? 0),
                    'gender' => $data['gender'] ?? '',
                ]);
            }
        }

        return array_filter($decoratedData);
    }
}
