<?php

namespace App\Controller;

use App\Entity\Collector;
use App\Model\Collector as ModelCollector;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CollectorController extends AbstractController
{
    /**
     *
     * @var EntityManagerInterface
     */
    protected EntityManagerInterface $entityManager;

    /**
     *
     * @var ModelCollector
     */
    protected ModelCollector $modelCollector;

    public function __construct(
        EntityManagerInterface $entityManager,
        ModelCollector $modelCollector
    ) {
        $this->entityManager = $entityManager;
        $this->modelCollector = $modelCollector;
    }

    /**
     * @Route("/collectors", methods={"GET"})
     */
    public function getAll(): Response
    {
        $repositoryCollectors = $this->entityManager->getRepository(Collector::class);

        $collectors = $repositoryCollectors->findAll();

        return new JsonResponse($collectors);
    }

    /**
     * @Route("/collector", methods={"POST"})
     */
    public function save(Request $request): Response
    {
        $body = $request->getContent();
        $collector = $this->modelCollector->createCollector($body);

        $this->entityManager->persist($collector);
        $this->entityManager->flush();

        return new JsonResponse($collector);
    }

    /**
     * @Route("/collectors/{id}", methods={"GET"})
     */
    public function getOneBy(int $id): Response
    {
        $collector = $this->getOneById($id);

        $code = $collector ? Response::HTTP_OK : Response::HTTP_NO_CONTENT;

        return new JsonResponse($collector, $code);
    }

    /**
     * @Route("/collectors/{id}", methods={"PUT"})
     */
    public function update(int $id, Request $request): Response
    {
        $body = $request->getContent();
        $collector = $this->modelCollector->createCollector($body);

        $existingCollector = $this->getOneById($id);

        if (!$existingCollector) {
            return new JsonResponse(status: Response::HTTP_BAD_REQUEST);
        }

        $existingCollector->mainName = $collector->mainName;
        $existingCollector->fetchCollection = $collector->fetchCollection;
        $existingCollector->receiveCollection = $collector->receiveCollection;
        $existingCollector->phoneNumberCall = $collector->phoneNumberCall;

        $this->entityManager->persist($existingCollector);
        $this->entityManager->flush();

        return new JsonResponse($existingCollector, Response::HTTP_ACCEPTED);
    }

    private function getOneById(int $id): Collector
    {
        $repositoryCollectors = $this->entityManager->getRepository(Collector::class);

        return $repositoryCollectors->find($id);
    }
}
