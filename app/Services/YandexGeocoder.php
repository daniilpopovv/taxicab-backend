<?php

declare(strict_types=1);

namespace App\Services;

class YandexGeocoder
{
    public function getCoordinates(string $address): array
    {
        $API_KEY = env('YANDEX_GEOCODER_API_KEY');
        $encodedAddress = urlencode($address);
        $url = "https://geocode-maps.yandex.ru/1.x/?format=json&geocode=$encodedAddress&apikey=$API_KEY";

        $response = file_get_contents($url);
        $data = json_decode($response, true);

        $coordinates = $data['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['Point']['pos'];
        [$longitude, $latitude] = explode(' ', $coordinates);

        return compact('latitude', 'longitude');
    }
}
