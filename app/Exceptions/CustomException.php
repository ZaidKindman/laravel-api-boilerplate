<?php

namespace App\Exceptions;

use Exception;

class CustomException extends Exception
{
    public static function InternalServerErrorException($message = "Internal Server Error")
    {
        return new static($message, 500);
    }

    public static function NotFoundException($message = "Object Not Found")
    {
        return new static($message, 404);
    }

    public static function BadRequestException($message = "Bad Request")
    {
        return new static($message, 400);
    }
}
