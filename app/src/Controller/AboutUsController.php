<?php

namespace App\Controller;

use App\Repository\AboutUsRepository;

class AboutUsController extends BaseController
{
    public function __construct(AboutUsRepository $aboutUsRepository)
    {
        parent::__construct($aboutUsRepository);
    }
}
