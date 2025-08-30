<?php

namespace App\Exceptions;

use App\Exceptions\Abstractions\ApiException;
use Exception;

class DBOperationException extends APIException
{
    public function __construct(string $message = "", int $statusCode = 500)
    {
        parent::__construct(message: $message, statusCode: $statusCode);
    }
}
