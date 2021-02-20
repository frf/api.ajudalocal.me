<?php

namespace App\Api\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LocaleResource extends JsonResource
{
    public function toArray($request)
    {
        /** @var UserBag $this */
        return [
            'id' => $this->getKey(),
            'name' => $this->name,
        ];
    }
}
