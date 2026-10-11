<?php

namespace App\Http\Controllers\Api;

use Exception;

class Controller
{
    protected function errorHandler(string $message, Exception $error)
    {
        return new Exception($message, previous:$error);
    }
}
