<?php

declare(strict_types=1);

namespace App\Enum;

use App\Model\EnumModel;
use Symfony\Contracts\Translation\TranslatorInterface;

trait EnumTrait {

    public static function getValues(): array
    {
        $cases = self::cases();

        return array_map(static fn (\UnitEnum $case) => $case->value, $cases);
    }

    public static function getList(TranslatorInterface $translator, string $prefix): array
    {
        $cases = self::cases();
        $list = [];
        foreach($cases as $case) {
            $object = new EnumModel();
            $object->value = $case->value;
            $object->label = $translator->trans($prefix . '.' . $case->label(), [], 'enum');
            $list[] = $object;
        }
        return $list;
    }

    public function label(): string
    {
        return static::getLabel($this);
    }
}
