<?php

declare(strict_types=1);

namespace App\Exceptions\Abstractions;

use Exception;

abstract class ApiException extends Exception
{
    public function __construct(
        string $message,
        protected int $statusCode {
            get {
                return $this->statusCode;
            }
        })
    {
        parent::__construct($message);
    }

    final public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
