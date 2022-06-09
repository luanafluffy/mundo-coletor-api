<?php

namespace App\Controller;

use App\Entity\Collector;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CollectorController
{
    /**
     * @Route("/collector", methods={"GET"})
     */
    public function getAll(Request $request): Response
    {
        $pathInfo = $request->getPathInfo();
        $queryString = $request->query->get('id');
        $queryStringAll = $request->query->all();

        return new JsonResponse([
            'collectors' => [
                [
                    'id' => 1,
                    'nome' => 'Luana Mesquita',
                ],
            ],
            'pathInfo' => $pathInfo,
            'query_string' => $queryString,
            'query_string_all' => $queryStringAll,
        ]);
    }

    /**
     * @Route("/collector", methods={"POST"})
     */
    public function new(Request $request): Response
    {
        $body = $request->getContent();
        $dataJson = json_decode($body);

        $collector = new Collector(
            $dataJson->main_name,
            $dataJson->fetch_collection,
            $dataJson->receive_collection,
            $dataJson->phone_number_call,
            $dataJson->facebook,
            $dataJson->instagram,
            $dataJson->whatsapp,
            $dataJson->image,
        );

        return new JsonResponse($collector);
    }
}
