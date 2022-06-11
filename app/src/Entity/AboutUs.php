<?php

namespace App\Entity;

use App\Repository\AboutUsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AboutUsRepository::class)]
class AboutUs implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 1000)]
    private $text;

    public function getText(): ?string
    {
        return $this->text;
    }

    public function jsonSerialize(): array
    {
        return [
            'text' => $this->getText(),
        ];
    }
}
