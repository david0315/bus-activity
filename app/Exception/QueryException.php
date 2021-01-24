<?php

namespace App\Exception;

use App\Constants\ErrorCode;
use Throwable;

class QueryException extends BusinessException
{
    public function __construct(int $code = 0, string $message = null, Throwable $previous = null)
    {
        if (is_null($message)) {
            $message = ErrorCode::getMessage($code);
        }

        parent::__construct($code, $message, $previous);
    }
}