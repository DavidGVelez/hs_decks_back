<?php

namespace App\Http\Controllers;

use App\Repositories\CardRepository;


class CardController extends Controller
{
    protected $repository;


    public function __construct(CardRepository $card)
    {
        $this->repository = $card;
    }


    public function find_one($id)
    {
        return $this->repository->findOneById($id);
    }

    public function find_all()
    {
        return $this->repository->findAll();
    }
}
