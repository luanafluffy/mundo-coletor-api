<?php

namespace App\Controller;

use App\Helper\RequestDataExtractor;
use App\Helper\ValidateCodeHttp;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseController extends AbstractController
{
    use ValidateCodeHttp;
    use RequestDataExtractor;

    private ObjectRepository $repository;

    public function __construct(ObjectRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(Request $request): Response
    {
        $queryString = $this->getQueryStringDatas($request);
        $order = $this->getOrderDatas($request);
        [$page, $size] = $this->getPaginationDatas($request);

        $entityList = $this->repository->findBy($queryString, $order, $size, ($page - 1) * $size);

        $code = $this->getCodeBetween($entityList, Response::HTTP_OK, Response::HTTP_NO_CONTENT);

        return new JsonResponse($entityList, $code);
    }

    public function getOne(int $id): JsonResponse
    {
        $entity = $this->repository->find($id);

        $code = $this->getCodeBetween($entity, Response::HTTP_OK, Response::HTTP_BAD_REQUEST);

        return new JsonResponse($entity, $code);
    }
}
