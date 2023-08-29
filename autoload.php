<?php

spl_autoload_register(function ($className) {
    $fileName = __DIR__ . DIRECTORY_SEPARATOR . $className . '.php';

    if (is_readable($fileName)) {
        require_once($fileName);
    }
});
