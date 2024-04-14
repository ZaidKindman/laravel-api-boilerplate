<?php

namespace App\Exceptions\Todo;

use App\Exceptions\CustomException;

class TodoException extends CustomException
{
    public static function TodoNotFoundException()
    {
        return new self("Todo Not Found", 404);
    }
}
