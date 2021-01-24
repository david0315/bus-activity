<?php

declare(strict_types=1);

namespace App\Exception\Handler;

use App\Kernel\Http\Response;
use Psr\Http\Message\ResponseInterface;
use Throwable;

/**
 * 重写 表单验证 异常类
 * Class ValidationExceptionHandler
 * @package App\Exception\Handler
 * Date: 4/12/19
 * Time: 14:32
 * Author: david.li
 */
class ValidationExceptionHandler extends \Hyperf\Validation\ValidationExceptionHandler
{
    protected $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $this->stopPropagation();
        /** @var \Hyperf\Validation\ValidationException $throwable */
        $body = $throwable->validator->errors()->first();

        return $this->response->error($body, $throwable->status);
    }
}
