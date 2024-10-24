<?php

declare(strict_types=1);

namespace App\Enum;

enum FamilySituationType: string implements EnumListInterface
{
    use EnumTrait;

    case MARRIED = 'married';
    case SINGLE = 'single';

    public static function getLabel($value): string
    {
        return match($value) {
            self::MARRIED => 'married',
            self::SINGLE => 'single'
        };
    }
}
