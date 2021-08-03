# Test One Company
### Описание
Тестовое задание
### Оглавление
 ____
+ [Используемые технологии](#technologies-used)
+ [Порядок развертывания](#deployment-order)
+ [Описание АРI](#description-api)
+ [Структура БД](#database-structure)


### Используемые технологии <a name="technologies-used"></a>
 ____
- php 7.3 +
- Laravel 8
- MySql

### Порядок развертывания <a name="deployment-order"></a>
 ____

1. Установим зависимостей:
```
composer install
```
2. Создаем файл `.env`. Пример содержимого файла находится в файле `example.env`

3. Выполнить команды миграции и оптимизацию

```
php artisan migrate --seed
php artisan optimize
```

4. Запускаем приложение на локальном устройстве:
```
php artisan serve
```

### Описание АРI <a name="description-api"></a>
 ____

#### Авторизация

```
POST /api/v1/auth/token
```
###### Заголовки (headers)
Ключ|Значение
--------|--------
Accept| application/json

###### Параметры запроса
Параметр|Описание|Тип
--------|--------|---
app_id| Ключ приложения | body
password| Пароль приложения | body
app_name| Название приложения | body
###### Пример запроса
Лимит запросов с одного IP - 5/min
```
POST /api/v1/auth/token
{
    "app_id":"86b2754c-c999-11eb-b8bc-0242ac130003",
    "password":"26454b14-44ab-4c02-b4e3-f67e1626266e",
    "app_name":"test user"
}
```
###### Положительый ответ
```
{
    "data": "1|gH0pFAE4kiAabLoUCcIdaPXLI9Ttf2jVkqo7kyWb",
    "message": "Приложение успешно авторизовано"
}
```
###### Ошибка
```
{
    "message": "Ошибка авторизации"
}
```
___

#### Задачи (Tasks)
____

###### Получение списка задач


```
GET /api/v1/tasks
```
###### Заголовки (headers)
Ключ|Значение
--------|--------
Accept| application/json
Authorization| Bearer ТОКЕН

###### Параметры запроса
Параметр|Описание|Тип
--------|--------|---
limit| Максимальное полличество задач в ответе | query
page| Номер страницы | query
###### Пример запроса
Лимит запросов с одного IP - 60/min
```
GET /api/v1/tasks?limit=2
```
###### Положительый ответ
```
{
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": 3,
                "name": "task1",
                "description": "da...",
                "created_at": "2021-08-03 12:08:00",
                "updated_at": "2021-08-03 12:08:00"
            },
            {
                "id": 4,
                "name": "task1",
                "description": "da...",
                "created_at": "2021-08-03 12:08:00",
                "updated_at": "2021-08-03 12:08:00"
            }
        ],
        "first_page_url": "http://127.0.0.1:8000/api/v1/tasks?page=1",
        "from": 1,
        "next_page_url": "http://127.0.0.1:8000/api/v1/tasks?page=2",
        "path": "http://127.0.0.1:8000/api/v1/tasks",
        "per_page": 2,
        "prev_page_url": null,
        "to": 2
    },
    "message": ""
}
```
###### Ошибка
```
{
    "message": "Ошибка"
}
```
___
###### Получение задачи по ID

```
GET /api/v1/tasks/id
```
###### Заголовки (headers)
Ключ|Значение
--------|--------
Accept| application/json
Authorization| Bearer ТОКЕН
###### Параметры запроса
Параметр|Описание|Тип
--------|--------|---
id| id задачи | params
###### Пример запроса
Лимит запросов с одного IP - 60/min
```
GET /api/v1/tasks/3
```
###### Положительый ответ
```
{
    "data": {
        "id": 3,
        "name": "task1",
        "description": "da...",
        "created_at": "2021-08-03 12:08:00",
        "updated_at": "2021-08-03 12:08:00"
    },
    "message": ""
}
```
###### Ошибка
```
{
    "message": "Ошибка"
}
```

___
###### Создание задачи

```
POST /api/v1/tasks
```
###### Заголовки (headers)
Ключ|Значение
--------|--------
Accept| application/json
Authorization| Bearer ТОКЕН
###### Параметры запроса
Параметр|Описание|Тип
--------|--------|---
name| название задачи | body
description| описание задачи | body
###### Пример запроса
Лимит запросов с одного IP - 60/min
```
POST /api/v1/tasks
{
    "name":"task name",
    "description":"task description"
}
```
###### Положительый ответ (201)
```
{
    "data": {
        "name": "task name",
        "description": "task description",
        "updated_at": "2021-08-03 05:08:47",
        "created_at": "2021-08-03 05:08:47",
        "id": 25
    },
    "message": "Задача успешно создана"
}
```
###### Ошибка (400)
```
{
    "message": "Ошибка валидации",
    "data": {
        "name": [
            "The name field is required."
        ],
        "description": [
            "The description field is required."
        ]
    }
}
```
###### Ошибка (500)
```
{
    "message": "Ошибка"
}
```
___
###### Обновление задачи

```
PUT /api/v1/tasks
```
###### Заголовки (headers)
Ключ|Значение
--------|--------
Accept| application/json
Authorization| Bearer ТОКЕН
###### Параметры запроса
Параметр|Описание|Тип
--------|--------|---
name| название задачи | body
description| описание задачи | body
###### Пример запроса
Лимит запросов с одного IP - 60/min
```
PUT /api/v1/tasks
{
    "name":"task name1",
    "description":"task description1"
}
```
###### Положительый ответ (201)
```
{
    "data": {
        "name": "task name1",
        "description": "task description1",
        "updated_at": "2021-08-03 05:08:47",
        "created_at": "2021-08-03 05:09:13",
        "id": 25
    },
    "message": "Задача успешно создана"
}
```
###### Ошибка (400)
```
{
    "message": "Ошибка валидации",
    "data": {
        "name": [
            "The name field is required."
        ],
        "description": [
            "The description field is required."
        ]
    }
}
```
###### Ошибка (500)
```
{
    "message": "Ошибка"
}
```
___
###### Удаление задачи

```

DELETE /api/v1/tasks/id
```
###### Заголовки (headers)
Ключ|Значение
--------|--------
Accept| application/json
Authorization| Bearer ТОКЕН
###### Параметры запроса
Параметр|Описание|Тип
--------|--------|---
id| id задачи | params
###### Пример запроса
Лимит запросов с одного IP - 60/min
```
DELETE /api/v1/tasks/3
```
###### Положительый ответ
```
{
    "data": null,
    "message": "Задача успешно удалена"
}
```

###### Ошибка
```
{
    "message": "Ошибка"
}
```
___
### Структура БД <a name="database-structure"></a>

#### Пользователи (users)

| Имя |  Назначение | Тип
|----------------|:---------|:---------|
| id | Идентификатор пользователя | bigint(20)
| app_id  | Название приложения | varchar(255)
| password	 | Пароль | varchar(255)

#### Задачи (tasks)

| Имя |  Назначение | Тип
|----------------|:---------|:---------|
| id | Идентификатор задачи |bigint(20)
| name | Название |varchar(255)
| description  | Описание |varchar(1000)
| created_at | Дата создания |timestamp
| updated_at |  Дата изменения |timestamp
