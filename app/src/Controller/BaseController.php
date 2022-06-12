<?php

namespace App\Controller;

use App\Helper\ValidateCodeHttp;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseController extends AbstractController
{
    use ValidateCodeHttp;

    private ObjectRepository $repository;

    public function __construct(ObjectRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(): Response
    {
        $entityList = $this->repository->findAll();

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
