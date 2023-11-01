<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Enum\OrderStatusEnum;
use App\Models\Order;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class OrderRepository
{
    public function findById(string $id): Order
    {
        return Order::whereId($id)->firstOrFail();
    }

    public function getAll(): Collection
    {
        return Order::all();
    }

    public function create($fields): Order
    {
        return new Order($fields);
    }

    public function validate(array $fields): array
    {
        $rules = [
            'phone_number' => 'required|regex:/^\+?\d{7,}$/',
            'from_address' => 'required|json',
            'to_address' => 'required|json',
        ];

        return Validator::validate($fields, $rules);
    }

    public function cancel(Order $order): Order
    {
        $order->status = OrderStatusEnum::CANCELLED->value;
        $order->save();

        return $order;
    }
}
