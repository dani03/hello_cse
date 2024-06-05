<?php

namespace App\Observers;

use App\Models\Profil;
use Illuminate\Support\Facades\Cache;

class ProfilObserver
{
    /**
     * Handle the Profil "created" event.
     */
    public function created(Profil $profil): void
    {
        //suppression du cache profil si un profil est crée
        Cache::forget('profils');
    }

    /**
     * Handle the Profil "updated" event.
     */
    public function updated(Profil $profil): void
    {
        //suppression du cache profil si un profil est crée
        Cache::forget('profils');
    }

    /**
     * Handle the Profil "deleted" event.
     */
    public function deleted(Profil $profil): void
    {
        //suppression du cache profil si un profil est crée
        Cache::forget('profils');
    }


}
