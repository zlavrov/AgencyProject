<?php

declare(strict_types=1);

namespace App\Enum;

interface EnumListInterface
{
    public static function getLabel($value): string;
}
