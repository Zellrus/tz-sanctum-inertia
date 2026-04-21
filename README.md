### Развертывание с помощью Docker: 
1. Переименовать .env.example в .env
2. Сбилдить и поднять проект -  `docker-compose up` 
3. Войти в контейнер приложения - `docker exec -it todo_app bash`


### Развертывание без Docker:
1. Переименовать .env.example в .env
2. Вставить свои значения БД в .env


### Общее:
1. Установить зависимости - `composer i`
2. Установить ключ приложения - `php artisan key:generate`
3. Запустить миграцию - `php artisan migrate`
4. Создать пользователя - `php artisan db:seed --class=UserSeeder` (в консоли появится токен)
