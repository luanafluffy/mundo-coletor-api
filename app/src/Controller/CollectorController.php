<?php

namespace App\Controller;

use App\Entity\Collector;
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

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
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
        $dataJson = json_decode($body);

        $collector = new Collector(
            $dataJson->main_name,
            $dataJson->fetch_collection,
            $dataJson->receive_collection,
            $dataJson->phone_number_call
        );

        $this->entityManager->persist($collector);
        $this->entityManager->flush();

        return new JsonResponse($collector);
    }

    /**
     * @Route("/collectors/{id}", methods={"GET"})
     */
    public function getOneBy(int $id): Response
    {
        $repositoryCollectors = $this->entityManager->getRepository(Collector::class);
        $collector = $repositoryCollectors->find($id);

        $code = $collector ? Response::HTTP_OK : Response::HTTP_NO_CONTENT;

        return new JsonResponse($collector, $code);
    }

    /**
     * @Route("/collectors/{id}", methods={"PUT"})
     */
    public function update(int $id, Request $request): Response
    {
        $body = $request->getContent();
        $dataJson = json_decode($body);

        $collector = new Collector(
            $dataJson->main_name,
            $dataJson->fetch_collection,
            $dataJson->receive_collection,
            $dataJson->phone_number_call
        );

        $repositoryCollectors = $this->entityManager->getRepository(Collector::class);
        $collectorExist = $repositoryCollectors->find($id);

        if (!$collectorExist) {
            return new JsonResponse(status: Response::HTTP_BAD_REQUEST);
        }

        $collectorExist->mainName = $collector->mainName;
        $collectorExist->fetchCollection = $collector->fetchCollection;
        $collectorExist->receiveCollection = $collector->receiveCollection;
        $collectorExist->phoneNumberCall = $collector->phoneNumberCall;

        $this->entityManager->persist($collectorExist);

        $this->entityManager->flush();

        return new JsonResponse($collectorExist, Response::HTTP_ACCEPTED);
    }
}
