<?php

/**
 * Enum file type class for accessing values where needed in classes.
 */

namespace App\Enum;

Enum FileTypes:string
{
    case CSV = 'csv';
    case XML = 'xml';
    case JSON = 'json';
}
