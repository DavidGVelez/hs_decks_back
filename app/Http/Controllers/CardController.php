<?php

namespace App\Http\Controllers;

use App\Repositories\CardRepository;
use Illuminate\Http\Request;


class CardController extends Controller
{
    protected $repository;


    public function __construct(CardRepository $card)
    {
        $this->repository = $card;
    }


    public function findOne($id)
    {
        return $this->repository->findOneById($id);
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }
}
