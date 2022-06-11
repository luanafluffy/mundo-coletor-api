<?php

namespace App\Controller;

use App\Repository\StateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class StateController extends AbstractController
{
    private StateRepository $stateRepository;

    public function __construct(StateRepository $stateRepository)
    {
        $this->stateRepository = $stateRepository;
    }

    #[Route('/states', name: 'app_state', methods: 'GET')]
    public function index(): JsonResponse
    {
        $states = $this->stateRepository->findAll();

        return $this->json($states ?? []);
    }
}
