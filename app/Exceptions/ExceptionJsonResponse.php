<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ExceptionJsonResponse extends Exception
{
    /**
     * Render the exception as an HTTP response.
     */
    public function render(Request $request): JsonResponse
    {
        $code = $this->getCode();
        $previous = $this->getPrevious();
        $httpStatus = $code >= 400 && $code <= 599 ? $code : 500;
        $error_message = ["error" => $this->message];
        if (env('APP_DEBUG'))
            $error_message = [
                ...$error_message,
                "message" =>  $previous->getMessage(),
                "exception" =>  $previous,
                "trace" =>  $previous->getTrace()
            ];
        return response()->json($error_message, $httpStatus);
    }
}
