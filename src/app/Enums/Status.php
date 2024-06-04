<?php
namespace App\Enums;

enum Status: int
{
    case INACTIF = -1;
    case EN_ATTENTE = 0;
    case ACTIF = 1;

    public function label(): string
    {
        return match ($this) {
            self::INACTIF => 'inactif',
            self::EN_ATTENTE => 'en attente',
            self::ACTIF => 'actif',
        };
    }
}
