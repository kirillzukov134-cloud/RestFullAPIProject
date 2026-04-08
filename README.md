# Students API

Простое API для управления студентами. Можно добавлять, удалять, изменять и смотреть список студентов.

## Установка
1. Скачай проект на комп.
2. Импортируй файл students.sql в phpMyAdmin.
3. Открой Backend/Config/connectDB.php и впиши свой пароль от MySQL.
4. Запусти через OpenServer.
5. Настрой виртуальный хост в OpenServer:
    1. Открой Настройки → Домены
    2. Добавь домен: Backend
    3. Укажи путь к папке Backend в проекте
    4. Перезапусти OpenServer
    5. Открой в браузере файл Frontend/index.html

   
## Как работать с API
**1. Получить всех студентов:**
GET http://restfullapiproject/Backend/students

**2. Добавить студента:**
POST http://restfullapiproject/Backend/students
Пример:
```json
{
  "name": "Иван",
  "surname": "Петров",
  "groups": "21-ИСП",
  "email": "ivan@mail.ru"
}
```

**3. Получить одного студента:**
GET http://restfullapiproject/Backend/students/17
(где 17 - ID студента)

**4. Обновить студента:**
PATCH http://restfullapiproject/Backend/students/17
Пример:
```json
{
  "name": "Кирилл",
  "surname": "Жуков",
  "groups": "22-ИСП",
  "email": "kirill@mail.ru"
}
```
(обновит студента с ID=17)

**5. Удалить студента:**
DELETE http://restfullapiproject/Backend/students/17
(удалит студента с ID=17)
