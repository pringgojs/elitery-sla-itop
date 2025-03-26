<?php

namespace App\Exceptions;

use Exception;

class AppException extends Exception
{
    // Custom message can be passed when throwing this exception
    public function __construct($message = 'Custom exception occurred', $code = 0, ?Exception $previous = null)
    {
        // Call the parent constructor to ensure everything is initialized properly
        parent::__construct($message, $code, $previous);
    }

    // Optional: You can customize the report method
    public function report()
    {
        // Log the exception or perform any additional reporting
        \Log::error($this->getMessage());
    }

    // Optional: You can customize the render method to return a custom response
    public function render($request)
    {
        return response()->view('exception', [
            'error' => $this->getMessage(),
        ], 500);
    }
}
