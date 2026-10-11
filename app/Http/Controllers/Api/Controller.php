<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ExceptionJsonResponse;
use Exception;

class Controller
{
    protected function errorHandler(string $message, Exception $error)
    {
        throw new ExceptionJsonResponse($message,previous:$error);
    }
}
