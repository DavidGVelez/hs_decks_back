<?php

namespace App\Repositories;

use App\Models\Card;

class CardRepository implements RepositoryInterface
{

    protected $card;

    public function __construct(Card $card)
    {
        $this->card = $card;
    }


    public function findOneById($id)
    {
        return $this->card->find($id);
    }

    public function findAll()
    {
        return $this->card->all();
    }
}
