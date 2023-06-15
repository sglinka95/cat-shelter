<?php

namespace App\Enums;

enum PositionEnum: string
{
    case MANAGER = 'manager';
    case MEDICAL_WORKER = 'medical worker';
    case GUARDIAN = 'guardian';
    case VOLUNTEER = 'volunteer';
    case CUSTOMER_SERVICE = 'customer service';
    case ANIMAL_PSYCHOLOGIST = 'animal psychologist';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
