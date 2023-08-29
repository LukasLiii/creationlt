<?php

/**
 * Handles different types of files.
 */

namespace App\Factory;

use App\Enum\FileTypes;
use App\Factory\FileHandlerInterface;
use Exception;

class FileFactory
{
    /* Do this, because we only need to call one of them when we need it.
        We don't need to instantiate all of them when the class is called. */
    private ?CsvFileHandler $csvFileHandler = null;
    private ?JsonFileHandler $jsonFileHandler = null;
    private ?XmlFileHandler $xmlFileHandler = null;

    public function __construct(
        CsvFileHandler $csvFileHandler = null,
        JsonFileHandler $jsonFileHandler = null,
        XmlFileHandler $xmlFileHandler = null,
    ) {
        $this->csvFileHandler = $csvFileHandler;
        $this->jsonFileHandler = $jsonFileHandler;
        $this->xmlFileHandler = $xmlFileHandler;
    }

    /**
     * Creates file handler, returns matched object.
     *
     * @param string $fileType File type, e.g. "csv", "xml", "json", etc.
     * @return FileHandlerInterface
     * @throws Exception If file type is undefined.
     */
    public function createFileHandler(string $fileType): FileHandlerInterface
    {
        return match ($fileType) {
            /* We do this for each of them, so it would be easier to write tests */
            FileTypes::CSV->value => $this->getCsvFileHandler(),
            FileTypes::JSON->value => $this->getJsonHandler(),
            FileTypes::XML->value => $this->getXmlHandler(),

            default => throw new Exception('Undefined file type ' . $fileType),
        };
    }

    /**
     * Get csv file handler object.
     *
     * Refers to the comment written above properties.
     *
     * @return CsvFileHandler
     */
    private function getCsvFileHandler(): CsvFileHandler
    {
        return $this->csvFileHandler ?? new CsvFileHandler();
    }

    /**
     * Get json file handler object.
     *
     * @return JsonFileHandler
     */
    private function getJsonHandler(): JsonFileHandler
    {
        return $this->jsonFileHandler ?? new JsonFileHandler();
    }

    /**
     * Get xml file handler object.
     *
     * @return XmlFileHandler
     */
    private function getXmlHandler(): XmlFileHandler
    {
        return $this->xmlFileHandler ?? new XmlFileHandler();
    }
}
