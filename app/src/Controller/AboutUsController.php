<?php

namespace App\Controller;

use App\Repository\AboutUsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AboutUsController extends AbstractController
{
    private AboutUsRepository $aboutUsRepository;

    public function __construct(AboutUsRepository $aboutUsRepository)
    {
        $this->aboutUsRepository = $aboutUsRepository;
    }

    #[Route('/about-us', name: 'app_about_us')]
    public function getAll(): JsonResponse
    {
        $text = $this->aboutUsRepository->find(1);

        return $this->json($text);
    }
}
