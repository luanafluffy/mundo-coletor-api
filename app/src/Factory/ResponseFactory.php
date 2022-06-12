<?php

namespace App\Factory;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ResponseFactory
{
    private int $code;
    private mixed $responseContent;
    private ?int $page;
    private ?int $size;

    public function __construct(
        int $code = Response::HTTP_OK,
        mixed $responseContent,
        ?int $page  = null,
        ?int $size = null
    ) {
        $this->code = $code;
        $this->responseContent = $responseContent;
        $this->page = $page;
        $this->size = $size;
    }

    public function getResponse(): JsonResponse
    {
        $response = [
            'page' => $this->page,
            'size' => $this->size,
            'results' => $this->responseContent,
        ];

        if (!$this->page && !$this->size) {
            $response = $this->responseContent;
        }

        return new JsonResponse($response, $this->code);
    }
}
