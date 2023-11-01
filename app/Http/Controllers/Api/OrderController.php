<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Order\OrderResource;
use App\Models\Order;
use App\Repositories\OrderRepository;
use App\Services\YandexGeocoder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OrderController extends Controller
{
    public function __construct(
        private readonly OrderRepository $orderRepository
    ) {
    }

    public function getAll(): AnonymousResourceCollection
    {
        $orders = $this->orderRepository->getAll();

        return OrderResource::collection($orders);
    }

    public function create(FormRequest $request): OrderResource
    {
        $yandexGeocoder = app(YandexGeocoder::class);

        $validatedFields = $this->orderRepository->validate($request->all());

        $fromAddressFormatted = $validatedFields['from_address']['formatted_address'];
        $formAddressCoordinates = $yandexGeocoder->getCoordinates($fromAddressFormatted);
        $validatedFields['from_address'] = [
            'latitude' => $formAddressCoordinates['latitude'],
            'longitude' => $formAddressCoordinates['longitude'],
            'formatted_address' => $fromAddressFormatted,
            'description' => $validatedFields['from_address']['description'],
        ];

        $toAddressFormatted = $validatedFields['to_address']['formatted_address'];
        $toAddressCoordinates = $yandexGeocoder->getCoordinates($toAddressFormatted);
        $validatedFields['to_address'] = [
            'latitude' => $toAddressCoordinates['latitude'],
            'longitude' => $toAddressCoordinates['longitude'],
            'formatted_address' => $toAddressFormatted,
            'description' => $validatedFields['to_address']['description'],
        ];

        $order = $this->orderRepository->create($validatedFields);

        return new OrderResource($order);
    }

    public function cancel(Order $order): JsonResponse
    {
        $this->orderRepository->cancel($order);

        return response()->json('Заказ успешно отменен');
    }
}
