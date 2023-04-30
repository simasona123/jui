<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JadwalCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'dokter' => new DokterCollection($this->dokter),
            'tanggal_masuk' => $this->tanggal_masuk,
            'tanggal_selesai' => $this->tanggal_selesai,
            'ketersediaan' => $this->ketersediaan,
            'keterangan' => $this->keterangan,
        ];
    }
}
