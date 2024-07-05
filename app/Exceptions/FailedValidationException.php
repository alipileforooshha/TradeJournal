<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Response;

class FailedValidationException extends Exception
{
    public $errors;

    public function __construct($errors)
    {
        $this->errors = $errors;    
    }

    public function render()
    {
        return Response::error('درخواست نا معتبر است',$this->errors,422);
    }
}
