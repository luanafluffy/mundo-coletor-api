<?php

namespace App\Repository;

use App\Entity\Collector as EntityCollector;
use Doctrine\ORM\EntityManager;

class CollectorRepository
{
    public EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getOneById(int $id): ?EntityCollector
    {
        $repositoryCollectors = $this->entityManager->getRepository(Collector::class, $id);

        return $repositoryCollectors->find($id);
    }

    public function remove(EntityCollector $collector): void
    {
        $this->entityManager->remove($collector);
        $this->entityManager->flush();
    }

    public function save(EntityCollector $collector): void
    {
        $this->entityManager->persist($collector);
        $this->entityManager->flush();
    }

    public function update(EntityCollector $actualCollector, EntityCollector $newCollector): EntityCollector
    {
        $actualCollector->mainName = $newCollector->mainName;
        $actualCollector->fetchCollection = $newCollector->fetchCollection;
        $actualCollector->receiveCollection = $newCollector->receiveCollection;
        $actualCollector->phoneNumberCall = $newCollector->phoneNumberCall;

        $this->entityManager->persist($actualCollector);
        $this->entityManager->flush();

        return $actualCollector;
    }
}
