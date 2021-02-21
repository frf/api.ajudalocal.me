<?php

namespace App\Api\Resources;

use Domain\Locale\Bags\LocaleBag;
use Illuminate\Http\Resources\Json\JsonResource;

class LocaleResource extends JsonResource
{
    public function toArray($request)
    {
        /** @var LocaleBag $this */
        return [
            'id' => $this->getKey(),
            'name' => $this->name,
            'about' => $this->about,
            'type' => $this->type,
            'instructions' => $this->instructions,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }
}
