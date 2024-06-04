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
        // vérifie si l'utilisateur est authentifié
        if (auth()->check()) {
            $status = Status::fromValue((int) $this->status);
            $data['status'] = $status ?? "Status inconnu";
        }
        $data =  [

            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'image_path' => $this->image,

            //'status' => Status::fromValue((int)$this->status) ,
            'created_at' => Carbon::make($this->created_at)->diffForHumans(),
            'updated_at' => Carbon::make($this->updated_at)->diffForHumans(),
        ];



        return $data;
    }
}
