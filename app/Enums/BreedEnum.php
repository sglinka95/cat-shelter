<?php

namespace App\Enums;

enum BreedEnum: string
{
    case BENGAL_CAT = 'Bengal Cat';
    case BOMBAY_CAT = 'Bombay Cat';
    case PERSIAN_CAT_BREED = 'Persian Cat Breed';
    case SCOTTISH_FOLD_CAT_BREED = 'Scottish Fold Cat Breed';
    case TURKISH_VAN_CAT_BREED = 'Turkish Van Cat Breed';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
