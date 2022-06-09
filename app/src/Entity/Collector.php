<?php

namespace App\Entity;

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
    }
}
