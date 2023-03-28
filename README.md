# Taxicab - приложение для заказа такси
## Backend

Что используется:
- PHP 8.1
- Laravel
- Яндекс Геокодер API

Чтобы Яндекс Геокодер API работал, необходимо указать свой API-ключ в .env:
```YANDEX_GEOCODER_API_KEY=ВАШ API КЛЮЧ```

Весь образ собран в Docker, но в dev режиме:
```docker-compose up --build```

Приложение является API. Методы:
- GET /api/orders - получение всех заказов
- POST /api/order - создание нового заказа в формате:
```json
{
  "phone_number": "+78005553535",
    "from_address": {
      "formatted_address": "Москва, Волоколамское шоссе, 71к4",
	  "description": "Пятый подъезд"},
    "to_address": {
      "formatted_address": "Москва, Волоколамское шоссе, 71к2",
	  "description": "Побыстрее"
  }
}
```
- PUT /api/orders/{id}/cancel - отмена заказа в формате:
```json
{
  "id": 1
}
```

## Frontend
Фронтэнд-приложение можно найти по ссылке: https://github.com/daniilpopovv/taxicab-frontend
