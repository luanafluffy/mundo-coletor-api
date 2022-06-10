<?php

namespace App\Model;

use App\Entity\Collector as EntityCollector;

class Collector
{
    public function findAll(): EntityCollector
    {
        $repositoryCollectors = $this->entityManager->getRepository(
            Collector::class
        );

        return $repositoryCollectors->findAll();
    }

    public function createCollector(string $json): EntityCollector
    {
        $dataJson = json_decode($json);

        return new EntityCollector(
            $dataJson->main_name,
            $dataJson->fetch_collection,
            $dataJson->receive_collection,
            $dataJson->phone_number_call
        );
    }
}
