<?php

/**
 * Takes care of file processing.
 */
namespace App\Controller;

require_once __DIR__ . '/../../autoload.php';

use App\Factory\FileFactory;
use Exception;

class FileProcessController
{
    /**
     * Index method for processing request and printing data.
     * 
     * @return void
     */
    public function index(): void
    {
        /* Check if submit button was clicked */
        if (isset($_POST['submit'])) {
            $fileType = pathinfo($_FILES['fileName']['name'], PATHINFO_EXTENSION);
            try {
                /* Handle file */
                $fileFactory = new FileFactory();
                $fileHandler = $fileFactory->createFileHandler($fileType);
                $fileHandler->readData($_FILES['fileName']);
                $data = $fileHandler->decorateData();
    
                /* Output data as assoc. array */
                print_r($data);
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
    }
}
