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

    public static function fromValue(int $value): ?Status
    {
        return match ($value) {
            0 => self::EN_ATTENTE,
            1 => self::ACTIF,
            default => self::INACTIF,
        };
    }

    public static function fromLabel(string $label): ?Status
    {
        return match ($label) {
            'inactif' => self::INACTIF,
            'en attente' => self::EN_ATTENTE,
            'actif' => self::ACTIF,
            default => null,
        };
    }

    public static function allStatusValues(): array
    {
        return [
            self::EN_ATTENTE->value,
            self::ACTIF->value,
            self::INACTIF->value
        ];
    }

    public static function allStatusLabel(): array
    {
        return [
            self::EN_ATTENTE->label(),
            self::ACTIF->label(),
            self::INACTIF->label()
        ];
    }
}
