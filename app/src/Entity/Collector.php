<?php

namespace App\Entity;

class Collector
{
    public string $mainName;
    public bool $fetchCollection;
    public bool $receiveCollection;
    public ?string $phoneNumberCall = null;
    public ?string $facebook = null;
    public ?string $instagram = null;
    public ?string $whatsapp = null;
    public ?string $image = null;

    public function __construct(
        string $mainName,
        bool $fetchCollection,
        bool $receiveCollection,
        ?string $phoneNumberCall,
        ?string $facebook,
        ?string $instagram,
        ?string $whatsapp,
        ?string $image,
    ) {
        $this->mainName = $mainName;
        $this->fetchCollection = $fetchCollection;
        $this->receiveCollection = $receiveCollection;
        $this->phoneNumberCall = $phoneNumberCall;
        $this->facebook = $facebook;
        $this->instagram = $instagram;
        $this->whatsapp = $whatsapp;
        $this->image = $image;
    }
}
