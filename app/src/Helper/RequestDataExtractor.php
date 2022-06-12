<?php

namespace App\Helper;

use Symfony\Component\HttpFoundation\Request;

trait RequestDataExtractor
{
    private function getRequestDatas(Request $request): array
    {
        $queryString = $request->query->all();

        $order = array_key_exists('sort', $queryString)
            ? $queryString['sort']
            : [];

        unset($queryString['sort']);

        $size = array_key_exists('size', $queryString)
            ? $queryString['size']
            : 10;
        unset($queryString['size']);

        $page = array_key_exists('page', $queryString)
            ? $queryString['page']
            : 1;
        unset($queryString['page']);



        return [$queryString, $order, $page, $size];
    }

    public function getOrderDatas(Request $request): array
    {
        [, $order] = $this->getRequestDatas($request);

        return $order;
    }

    public function getQueryStringDatas(Request $request): array
    {
        [$queryString,] = $this->getRequestDatas($request);

        return $queryString;
    }

    public function getPaginationDatas(Request $request): array
    {
        [,, $page, $size] = $this->getRequestDatas($request);

        return [$page, $size];
    }
}
