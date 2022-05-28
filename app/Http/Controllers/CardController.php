<?php

namespace App\Http\Controllers;

use App\Http\Resources\CardResource;
use App\Services\Bnet\CardService;

class CardController extends Controller
{
    protected $cardService;


    public function __construct(CardService $cardService)
    {
        $this->cardService = $cardService;
    }


    public function find_one($id)
    {
        return new CardResource($this->cardService->findOneById($id));
    }

    public function find_all()
    {
        return $this->cardService->findAll();
    }
}
