<?php

declare(strict_types=1);

namespace App\Enum;

enum OrderStatusEnum: string
{
    use EnumValues;

    case CREATED = 'Новый';
    case CANCELLED = 'Отменен';
}
