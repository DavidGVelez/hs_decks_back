<?php

namespace App\Services\Bnet;

use App\Repositories\Bnet\CardRepository;


class CardService
{
    protected $cardRepository;

    public function __construct(CardRepository $cardRepository)
    {
        $this->cardRepository = $cardRepository;
    }

    public function findOneById($id)
    {
        return $this->cardRepository->find($id);
    }

    public function findAll()
    {
        return $this->cardRepository->all();
    }
}
