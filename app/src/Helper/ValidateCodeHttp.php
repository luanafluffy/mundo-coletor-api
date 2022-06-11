<?php

namespace App\Helper;

trait ValidateCodeHttp
{
    public function getCodeHttp($data, int $codeSuccess, int $codeFail): int
    {
        return $data ? $codeSuccess : $codeFail;
    }
}
