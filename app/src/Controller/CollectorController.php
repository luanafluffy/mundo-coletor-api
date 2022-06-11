<?php

namespace App\Controller;

use App\Helper\ValidateCodeHttp;
use App\Model\Collector as ModelCollector;
use App\Repository\CollectorRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CollectorController extends AbstractController
{
    use ValidateCodeHttp;

    /**
     *
     * @var CollectorRepository
     */
    protected CollectorRepository $repositoryCollector;

    /**
     *
     * @var ModelCollector
     */
    protected ModelCollector $modelCollector;

    public function __construct(
        CollectorRepository $repositoryCollector,
        ModelCollector $modelCollector
    ) {
        $this->repositoryCollector = $repositoryCollector;
        $this->modelCollector = $modelCollector;
    }

    /**
     * @Route("/collectors", methods={"GET"})
     */
    public function getAll(): Response
    {
        $collectors = $this->repositoryCollector->getAll();

        return new JsonResponse($collectors);
    }

    /**
     * @Route("/collector", methods={"POST"})
     */
    public function save(Request $request): Response
    {
        $collectorData = $request->getContent();
        $collector = $this->modelCollector->createCollector($collectorData);

        $this->repositoryCollector->save($collector);

        return new JsonResponse($collector);
    }

    /**
     * @Route("/collectors/{id}", methods={"GET"})
     */
    public function getOneBy(int $id): Response
    {
        $collector = $this->repositoryCollector->getOneById($id);

        $code = $this->getCodeHttp($collector, Response::HTTP_OK, Response::HTTP_NO_CONTENT);

        return new JsonResponse($collector, $code);
    }

    /**
     * @Route("/collectors/{id}", methods={"PUT"})
     */
    public function update(int $id, Request $request): Response
    {
        $collectorData = $request->getContent();
        $newCollector = $this->modelCollector->createCollector($collectorData);

        $actualCollector = $this->repositoryCollector->getOneById($id);

        if ($actualCollector) {
            $actualCollector = $this->repositoryCollector->update($actualCollector, $newCollector);
        }

        $code = $this->getCodeHttp($actualCollector, Response::HTTP_OK, Response::HTTP_NO_CONTENT);

        return new JsonResponse($actualCollector, $code);
    }

    /**
     * @Route("/collectors/{id}", methods={"DELETE"})
     */
    public function delete(int $id): Response
    {
        $collector = $this->repositoryCollector->getOneById($id);

        if ($collector) {
            $this->repositoryCollector->remove($collector);
        }

        $code = $this->getCodeHttp($collector, Response::HTTP_OK, Response::HTTP_NO_CONTENT);

        return new JsonResponse(status: $code);
    }
}
