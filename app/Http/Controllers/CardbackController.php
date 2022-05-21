<?php

namespace App\Http\Controllers;

use App\Services\Bnet\CardbackService;

class CardbackController extends Controller
{

    protected $cardbackService;


    public function __construct(CardbackService $cardbackService)
    {
        $this->cardbackService = $cardbackService;
    }


    public function find_one($id)
    {
        return $this->cardbackService->findOneById($id);
    }

    public function find_all()
    {
        return $this->cardbackService->findAll();
    }
}
