<?php

declare(strict_types=1);

namespace App\Enum;

enum SexType: string implements EnumListInterface
{
    use EnumTrait;

    case MALE = 'male';
    case FEMALE = 'female';
    case OTHER = 'other';

    public static function getLabel($value): string
    {
        return match($value) {
            self::MALE => 'male',
            self::FEMALE => 'female',
            self::OTHER => 'other'
        };
    }
}
