<?php

namespace App\Controller;

use App\Repository\StateRepository;

class StateController extends BaseController
{
    public function __construct(StateRepository $stateRepository)
    {
        parent::__construct($stateRepository);
    }
}
