<?php

namespace App\Services\Bnet;

use App\Repositories\Bnet\DeckRepository;

class DeckService
{
    protected $deckRepository;

    public function __construct(DeckRepository $deckRepository)
    {
        $this->deckRepository = $deckRepository;
    }
}
