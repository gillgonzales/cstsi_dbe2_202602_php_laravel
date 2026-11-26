<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProdutoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            ...parent::toArray($request),
            'importado' => $this->importado ? 'sim' : 'não',
           'medias' => $this->whenLoaded(
                'medias',
                fn() => $this->medias->map(
                    function($media){
                        $media->source = (str_contains($media->source,'http'))
                                ? $media->source
                                : asset(Storage::url('produtos/' . $media->source));
                        return $media;
                    }
                )
            )
        ];
    }
}
