<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Exceptions\Abstractions\ApiException;

final class DBOperationException extends ApiException
{
    public function __construct(string $message = '', int $statusCode = 500)
    {
        parent::__construct(message: $message, statusCode: $statusCode);
    }
}
