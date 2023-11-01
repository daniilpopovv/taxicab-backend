<?php

declare(strict_types=1);

namespace App\Http\Resources\Order;

use App\Models\Order;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public static $wrap = null;

    public function toArray($request): array
    {
        /** @var Order $order */
        $order = $this->resource;

        return [
            'id' => $order->id,
            'from_address' => $order->from_address,
            'to_address' => $order->to_address
        ];
    }
}
