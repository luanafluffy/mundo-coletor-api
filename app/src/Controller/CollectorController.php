<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

class CollectorController
{
    /**
     * @Route("/collector")
     */
    public function getCollectors(): void
    {
        echo "Coletor 1\nColetor 2\nColetor 3";
        exit();
    }
}
