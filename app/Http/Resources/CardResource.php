<?php

namespace App\Http\Resources;

use App\Repositories\Bnet\MetadataRepository;
use App\Services\Bnet\MetadataService;
use Illuminate\Http\Resources\Json\JsonResource;

class CardResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public function toArray($request)
    {

        $metadataService = new MetadataService(new MetadataRepository);
        return [
            "id" => $this->id,
            "name" => $this->name,
            "text" => $this->text,
            "collectible" => $this->collectible,
            "slug" => $this->slug,
            'classes' => $metadataService->getClasses(count($this->multiClassIds) > 0 ? $this->multiClassIds : [$this->classId]),
            "rarity" =>  $metadataService->getRarity($this->rarityId),
            "set" =>  $metadataService->getSet($this->cardSetId),
            "artist" => $this->artistName,
            "cropImage" => $this->cropImage,
            "flavor" => $this->flavorText,
            "image" => $this->image,
            "imageGold" => $this->imageGold,
            "keywords" =>  $metadataService->getKeywords($this->keywordIds),
            "manaCost" => $this->manaCost,
            "spellSchool" =>  $metadataService->getSpellSchool($this->spellSchoolId)
        ];
    }
}
