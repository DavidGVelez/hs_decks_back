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

        // * Those are common params to all cards
        $params = [
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
            "manaCost" => $this->manaCost,

        ];
        //* Specific params 

        if (isset($this->keywordIds)) {
            $params["keywords"] = $metadataService->getKeywords($this->keywordIds);
        }

        if (isset($this->spellSchoolId)) {
            $params["spellSchool"] = $metadataService->getSpellSchool($this->spellSchoolId);
        }
        if (isset($this->minionTypeId)) {
            $params["minionType"] = $metadataService->getMinionType($this->minionTypeId);
        }

        if (isset($this->childIds)) {
            $params["relatedCards"] = $this->childIds;
        }


        return $params;
    }
}
