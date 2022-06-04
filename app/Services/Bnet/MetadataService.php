<?php

namespace App\Services\Bnet;

use App\Repositories\Bnet\CardRepository;
use App\Repositories\Bnet\MetadataRepository;
use Illuminate\Support\Facades\Cache;

class  MetadataService
{

    protected $metadataRepository;
    protected $cardRepository;
    protected $TTL = 1440; // 1 day in mins;

    public function __construct(MetadataRepository $metadataRepository)
    {
        $this->metadataRepository = $metadataRepository;
    }


    public function findByType($type)
    {

        if (!Cache::has('metadata_all')) {
            $res = $this->metadataRepository->all();
            Cache::set('metadata_all', $res, $this->TTL);
            return collect($res)->get($type);
        }
        return collect(Cache::get('metadata_all'))->get($type);
    }

    public function findAll()
    {
        if (!Cache::has('metadata_all')) {
            $res = $this->metadataRepository->all();
            Cache::set('metadata_all', $res, $this->TTL);
        }

        return Cache::get('metadata_all');
    }

    public function getRarity($rarity)
    {
        $rarities = collect($this->findByType('rarities'));
        return $rarities->filter(function ($item) use ($rarity) {
            return $item->id == $rarity;
        })->first();
    }
    public function getClasses($classes)
    {
        $classesList = collect($this->findByType('classes'));
        return collect($classesList->whereIn('id', $classes))->values()->map(function ($item) {
            return collect($item)->only(['id', 'slug', 'name']);
        });
    }
    public function getSpellSchool($spellSchool)
    {
        $spellSchools = collect($this->findByType('spellSchools'));

        return collect($spellSchools->whereIn('id', $spellSchool))->values();
    }
    public function getSet($set)
    {
        $sets = collect($this->findByType('sets'));
        return collect($sets->filter(function ($item) use ($set) {
            return $item->id == $set;
        })->first())->only(['id', 'slug', 'name']);
    }

    public function getKeywords($keywords)
    {
        $keywordList = collect($this->findByType('keywords'));
        return collect($keywordList->whereIn('id', $keywords))->values();
    }

    public function getGameModes($gamemodes)
    {
        $gamemodesList = collect(self::findByType('gameModes'));

        return collect($gamemodesList->whereIn('id', $gamemodes))->values();
    }

    public function getSetGroups($setGroups)
    {
        $setGroupsList = collect($this->findByType('setGroups'));

        return collect($setGroupsList->whereIn('id', $setGroups))->values();
    }

    public function getMinionType($type)
    {
        $minionTypes = collect($this->findByType('minionTypes'));

        return collect($minionTypes->whereIn('id', [$type]))->values();
    }
}
