Symfony CLI version 5.8.14 (c)

Версия Symfony: 6.2.14

## Установка

Установите зависимостей:

```bash
# composer
composer install
```
## Настройка БД

Используемая система: MySQL8

Сконфигурировать файл __*.env*__ для работы с БД

Запустить миграции:

```bash
# Инициализация таблицы
php bin/console doctrine:migrations:migrate
```

## Развернуть проект локально

Проект будет доступен по ссылке `http://localhost:8000`:

```bash
# symfony
symfony server:start
```
