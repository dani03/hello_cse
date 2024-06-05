<?php

namespace App\Models;

use App\Observers\ProfilObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy([ProfilObserver::class])]
class Profil extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['nom', 'prenom', "status", 'image'];
}
