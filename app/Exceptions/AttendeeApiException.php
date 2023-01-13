<?php

namespace App\Exceptions;

use Exception;

class AttendeeApiException extends Exception
{
    public function render($request)
    {
        return response()->json(['error' => 'You need to add a card first'], 500);
    }
}
