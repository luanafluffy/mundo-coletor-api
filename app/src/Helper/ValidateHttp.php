<?php

namespace App\Helper;

trait ValidateCodeHttp
{
    public function getCodeBetween($data, int $code1, int $code2): int
    {
        return $data ? $code1 : $code2;
    }
}
