<?php

namespace App\Services\Bnet;

use App\Repositories\Bnet\CardbackRepository;

class CardbackService
{
    protected $cardbackRepository;

    public function __construct(CardbackRepository $cardbackRepository)
    {
        $this->cardbackRepository = $cardbackRepository;
    }


    public function findOneById($id)
    {
        return $this->cardbackRepository->find($id);
    }

    public function findAll()
    {
        return $this->cardbackRepository->all();
    }
}
