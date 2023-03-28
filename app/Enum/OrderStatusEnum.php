<?php

declare(strict_types=1);

namespace App\Enum;

enum OrderStatusEnum: string
{
    case CREATED = 'Новый';
    case CANCELLED = 'Отменен';

    public static function values(): array
    {
        return [
            self::CREATED->value,
            self::CANCELLED->value,
        ];
    }
}
