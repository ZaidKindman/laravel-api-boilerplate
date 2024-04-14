<?php

namespace App\Exceptions\Auth;

use App\Exceptions\CustomException;

class AuthException extends CustomException
{
    public static function InvalidLoginCredentialsException()
    {
        return new self("Invalid login credentials", 401);
    }

    public static function UserNotFoundException()
    {
        return new self("User Not Found", 404);
    }
}
