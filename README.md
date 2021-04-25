# Тестовое задание PHP

## Инициализация проекта

1 Запустить команду в корневой директории `docker-compose up -d`

2 Зайти в контейнер с приложением `docker exec -it app bash`

3 Запустить команду для установки зависимостей `composer install`

 Доступны три маршрута  
 ` GET http://localhost/v1/advertisement/{advertisementId:\d+}`
 `POST http://localhost/v1/advertisement`
 `POST http://localhost/v1/advertisement/{advertisementId:\d+}`
