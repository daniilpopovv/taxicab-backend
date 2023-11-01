# Taxicab - приложение для заказа такси

## Backend

![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)
![Postgres](https://img.shields.io/badge/postgres-%23316192.svg?style=for-the-badge&logo=postgresql&logoColor=white)
![Docker](https://img.shields.io/badge/docker-%230db7ed.svg?style=for-the-badge&logo=docker&logoColor=white)
![Nginx](https://img.shields.io/badge/nginx-%23009639.svg?style=for-the-badge&logo=nginx&logoColor=white)

- Для получения координат и адресов используется Яндекс Геокодер API

Чтобы Яндекс Геокодер API работал, необходимо указать свой API-ключ в .env:
```YANDEX_GEOCODER_API_KEY=ВАШ API КЛЮЧ```

Весь образ собран в Docker в **dev режиме** - смотреть BUILD.md.

### Методы API:

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
