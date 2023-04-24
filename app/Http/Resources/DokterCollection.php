<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DokterCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $result = [
            'user' => $this->user,
            'nip' => $this->nip,
            'spesialis' => $this->spesialis,
            'jenis_kelamin' => $this->jenis_kelamin,
        ];

        $media = $this->user->getMedia();
        $image_url = count($media) == 0 ? "http://bmkg.go.id/asset/img/logo/logo-bmkg.png" : $media[0]->getUrl('preview');

        $result['img'] = $image_url;
        return $result;
    }
}
