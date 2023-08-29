<?php

namespace App\Factory;

use App\Factory\FileHandlerInterface;
use Exception;

class CsvFileHandler implements FileHandlerInterface
{
    /** @var array<int,<array<string>>> $data */
    private array $data = [];

    /**
     * Reads csv file.
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

        /* Try to open the file */
        if (($handle = fopen($file['tmp_name'], 'r')) !== false) {
            /* Gets row data */
            while (($row = fgetcsv($handle)) !== false) {
                $this->data[] = $row;
            }

            fclose($handle);
        }
    }

    /**
     * Decorates data.
     *
     * @return array<int,<array<int|string>>> Transformed data.
     */
    public function decorateData(): array
    {
        /* Remove csv header */
        array_shift($this->data);

        $transformedData = [];

        foreach ($this->data as $data) {
            $transformedData[] = array_filter([
                'First name' => $data[0] ?? '',
                'age' => (int) ($data[1] ?? 0),
                'gender' => $data[2] ?? '',
            ]);
        }

        return array_filter($transformedData);
    }
}
