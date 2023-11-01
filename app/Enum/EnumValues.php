<?php

declare(strict_types=1);

namespace App\Enum;

trait EnumValues
{
    public static function values(): array
    {
        return array_map(
            function ($v) {
                return $v->value;
            },
            self::cases()
        );
    }

    public static function random(array $without = []): self
    {
        $cases = array_filter(
            self::cases(),
            fn($case) => !in_array($case, $without)
        );
        return $cases[array_rand($cases)];
    }
}
