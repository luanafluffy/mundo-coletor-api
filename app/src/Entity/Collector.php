<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Collector
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    public int $id;

    /**
     * @ORM\Column(type="string")
     */
    public string $mainName;

    /**
     * @ORM\Column(type="integer")
     */
    public int $fetchCollection;

    /**
     * @ORM\Column(type="integer")
     */
    public int $receiveCollection;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    public ?string $phoneNumberCall = null;

    /**
     * @ORM\ManyToMany(targetEntity=CollectionMaterial::class, inversedBy="collectors")
     */
    private $collection_material;

    public function __construct(
        string $mainName,
        int $fetchCollection,
        int $receiveCollection,
        ?string $phoneNumberCall
    ) {
        $this->mainName = $mainName;
        $this->fetchCollection = $fetchCollection;
        $this->receiveCollection = $receiveCollection;
        $this->phoneNumberCall = $phoneNumberCall;
        $this->collection_material = new ArrayCollection();
    }

    /**
     * @return Collection<int, CollectionMaterial>
     */
    public function getCollectionMaterial(): Collection
    {
        return $this->collection_material;
    }

    public function addCollectionMaterial(CollectionMaterial $collectionMaterial): self
    {
        if (!$this->collection_material->contains($collectionMaterial)) {
            $this->collection_material[] = $collectionMaterial;
        }

        return $this;
    }

    public function removeCollectionMaterial(CollectionMaterial $collectionMaterial): self
    {
        $this->collection_material->removeElement($collectionMaterial);

        return $this;
    }
}
