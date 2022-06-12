<?php

namespace App\Controller;

use App\Repository\MaterialRepository;

class MaterialController extends BaseController
{
    public function __construct(MaterialRepository $materialRepository)
    {
        parent::__construct($materialRepository);
    }
}
