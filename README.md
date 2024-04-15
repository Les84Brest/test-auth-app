# Тестовое задание

## Развертывание проекта
1. Клонировать репозиторий в папку, хоста на сервере. Команда SSH
`git clone git@github.com:Les84Brest/test-auth-app.git .`
2. Переименовать `example.htaccess` в `.htaccess` - 
`cp example.htaccess .htaccess`
3. Запустить `composer install` для активации автозагрузки классов.
4. Сделать владельцем файла  базы данных текущего польователя Apache. `chown www-data:www-data ./src/Db/database.json` и установить для этого файла права на запись и чтение для владельца и группы -  `chmod 664 ./src/Db/database.json`

## Структура сайта
На сайте существует 4 страницы
- Главная
- О нас
- Блог
- Страница логина

##  Тестирование
Изначально в базе данных нет зарегистрированных пользователей.
Чтобы попасть на страницу входа и регистрации на сайте нажмите на кнопку `Войти`
В левой части будет форма входа, В правой форма регистрации.
Ошибки валидации и входа  на сайт отображаются под полями ввода.
При успешной регистрации на сайте происходит редирект на главную страницу. В шапке сейта появляется приветственное сообщение вида `Hello, <User  Name>`. Чтобы попасть обратно на страницу логина / регистрации нужно нажать кнопку `Выйти`. Для залогиненного пользователя страница регистрации становится недоступной.

## Описание папок

- templates - папка с шаблонами
- accets - папка со статическими файлами - изображения, CSS, JavaScript
- src - исходный код приложения
    - Api - интерфейсы классов
    - Controller - контроллеры
    - Db - база данных в виде JSON файла
    - Entity - классы для хранения представления объекта из базы данных
    - Helper - различные хэлперы
    - Model - классы модели ответственные за CRUD операции
    - Routing - все что касается роутинга - роутер, классы реквеста и респонса
    - Session - менеджент данными сессии
    - App.php - стартовый файл приложения
    - config.php - конфигурация



