<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Enum\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    public function index(): JsonResponse
    {
        $orders = Order::all();

        return response()->json($orders);
    }

    public function store(StoreOrderRequest $request): JsonResponse
    {
        $order = new Order($request->validated());

        $fromAddressFormatted = $order['from_address']['formatted_address'];
        $formAddressCoordinates = $this->getCoordinates($fromAddressFormatted);

        $order->from_address = [
            'latitude' => $formAddressCoordinates['latitude'],
            'longitude' => $formAddressCoordinates['longitude'],
            'formatted_address' => $fromAddressFormatted,
            'description' => $order['from_address']['description'],
        ];

        $toAddressFormatted = $order['to_address']['formatted_address'];
        $toAddressCoordinates = $this->getCoordinates($toAddressFormatted);

        $order->to_address = [
            'latitude' => $toAddressCoordinates['latitude'],
            'longitude' => $toAddressCoordinates['longitude'],
            'formatted_address' => $toAddressFormatted,
            'description' => $order['to_address']['description'],
        ];

        $order->save();

        return response()->json($order);
    }

    public function getCoordinates($address): array
    {
        $API_KEY = env('YANDEX_GEOCODER_API_KEY');
        $encodedAddress = urlencode($address);
        $url
            = "https://geocode-maps.yandex.ru/1.x/?format=json&geocode=$encodedAddress&apikey=$API_KEY";

        $response = file_get_contents($url);
        $data = json_decode($response, true);

        $coordinates
            = $data['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['Point']['pos'];
        [$longitude, $latitude] = explode(' ', $coordinates);

        return compact('latitude', 'longitude');
    }

    public function cancel($id): JsonResponse
    {
        $order = Order::find($id);
        $order->status = OrderStatusEnum::CANCELLED->value;
        $order->save();

        return response()->json('Заказ успешно отменен');
    }
}
