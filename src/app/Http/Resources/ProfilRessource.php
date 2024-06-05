<?php

namespace App\Http\Resources;

use App\Enums\Status;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class ProfilRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $data =  [

            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'image' => $this->image,
            'created_at' => Carbon::make($this->created_at)->diffForHumans(),
            'updated_at' => Carbon::make($this->updated_at)->diffForHumans(),
        ];
        // vérifie si l'utilisateur est authentifié
        if ($request->user()) {
            $status = Status::fromValue((int) $this->status);
            $data['status'] = $status?->label();
        }

        return $data;
    }
}
