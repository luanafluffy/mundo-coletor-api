<?php

namespace App\Helper;

use Symfony\Component\HttpFoundation\Response;

trait ValidateCodeHttp
{
    public function getCodeBetween(
        mixed $data,
        int $code1 = Response::HTTP_OK,
        int $code2 = Response::HTTP_BAD_REQUEST
    ): int {
        return $data ? $code1 : $code2;
    }
}
