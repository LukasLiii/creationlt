<?php

namespace App\Factory;

use App\Factory\FileHandlerInterface;
use Exception;

class JsonFileHandler implements FileHandlerInterface
{
    /** @var array<int,<array<string>>> $data */
    private array $data = [];

    /**
     * Reads json file.
     *
     * @param array<string> $file Uploaded file data.
     * @return void
     * @throws Exception if file is empty.
     */
    public function readData(array $file): void
    {
        /* Check if file contains errors */
        if ($file['error'] === UPLOAD_ERR_OK) {
            $filePath = $file['tmp_name'];
            $jsonData = file_get_contents($filePath);
            $this->data = empty($jsonData)
                ? []
                : json_decode($jsonData, true);
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
        foreach ($this->data as $data) {
            $decoratedData[] = [
                'First name' => $data['first_name'] ?? '',
                'age' => (int) ($data['age'] ?? 0),
                'gender' => $data['gender'] ?? '',
            ];
        }

        return $decoratedData;
    }
}
