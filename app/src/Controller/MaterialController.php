<?php

namespace App\Controller;

use App\Repository\MaterialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class MaterialController extends AbstractController
{
    private MaterialRepository $materialRepository;

    public function __construct(MaterialRepository $materialRepository)
    {
        $this->materialRepository = $materialRepository;
    }

    #[Route('/materials', name: 'app_material')]
    public function getAll(): JsonResponse
    {
        $materials = $this->materialRepository->findAll();

        return $this->json($materials ?? []);
    }
}
