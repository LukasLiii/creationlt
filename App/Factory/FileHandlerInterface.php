<?php

namespace App\Factory;

interface FileHandlerInterface
{
    /**
     * Reads file.
     *
     * @param array<string> $file Uploaded file data.
     * @return void
     */
    public function readData(array $file): void;

    /**
     * Decorates file data.
     *
     * @return array<int,<array<string>>> Transformed data.
     */
    public function decorateData(): array;
}
