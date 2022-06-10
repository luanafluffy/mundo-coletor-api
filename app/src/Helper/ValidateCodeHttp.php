<?php

namespace App\Helper;

use Symfony\Component\HttpFoundation\Response;

trait ValidateCodeHttp
{
    public function getCodeHttp204Or200($data): int
    {
        return $data ? Response::HTTP_OK : Response::HTTP_NO_CONTENT;
    }

    public function getCodeHttp202Or400($data): int
    {
        return $data ? Response::HTTP_OK : Response::HTTP_NO_CONTENT;
    }
}
