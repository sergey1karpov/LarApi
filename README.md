## Разворачивание проекта

- Склонировать репозиторий
- Поднять окружение **docker compose up -d**
- Документация доступна по **[localhost/api/documentation]()**
- Запуск теста **php artisan test**

## О проекте

- Добавление нового поставщика делается через реализацию интерфейса **TicketSellerInterface**
- В **AppServiceProvider** добавить нужную реализацию нужно привязать к интерфейсу **TicketSellerInterface**
- В **config/services.php** указать какая реализация будет использоваться через ключ **ticket-seller**
