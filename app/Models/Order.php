<?php

declare(strict_types=1);

namespace App\Models;

use App\Enum\OrderStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable
        = [
            'uuid',
            'phone_number',
            'from_address',
            'to_address',
            'status',
        ];

    protected $casts
        = [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'from_address' => 'json',
            'to_address' => 'json',
            'status' => OrderStatusEnum::class,
        ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->status = OrderStatusEnum::CREATED->value;
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }
}
