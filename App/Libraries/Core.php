<?php

require_once __DIR__ . '/../../autoload.php';

use App\Controller\FileProcessController;

/* Right now if the request method is post, it automatically calls
    file process controller. In the future this should be done so that it
    searches for specific controller. */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dataController = new FileProcessController();
    $dataController->index();
} else {
    echo "Invalid request method";
}
