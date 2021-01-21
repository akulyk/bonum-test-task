#Тестовое задание Bonum Studio
РНР (YII2) developer

Необходимо реализовать простую crm систему:
Необходимо использовать AdminLTE.
0. Вход в crm осуществляется с помощью логина и пароля
1. В crm должен быть список компаний. (возможность создать, изменить, удалить).
(должны быть валидация входящих данных)
2. Должен быть список клиентов компаний (возможность создать, изменить, удалить) (должны быть валидаторы входящих данных).
3. Клиенты в базе данных должны быть связаны с компаниями.
4. Таблицы должны быть описаны с помощью миграций.
5. Таблицы должны наполняться тестовыми данными. (сгенерировать больше 10 тысяч
значений в каждой базе)
6. Реализовать три rest api метода
6.1 Companies - должен возвращать список компаний в формате json с возможностью
пагинации
6.2 Clients - принимает айди компании, возвращает список клиентов в json с возможностью пагинации.
6.3 Client_companies - принимает айди клиента, возвращает список компаний связанных с клиентом.
7. При доступе к апи должна происходить bearer авторизация.
================================================================================
### Description
For test purpose only.

### Requirements   
php 7.4 

mysql 5.6 or higher (keep in mind that with ^5.7 can be `Not in Group By` error)

### How to use

1. Run command `git clone https://github.com/akulyk/bonum-test-task.git`
2. Run command `compose install` (you should already have composer installed)   
3. Run command `php init` and select `Development mode` (not tested on prod)
4. Set up own db settings in `/common/config/mail-local.php`
5. Run command `php yii migrate`
   (default user to use with `backend` or `api`:
   email: `admin@site.test`
   password: `password`).
   To get access to api by getting JWT token you have to login first to `/user/login`
6. Set number of fixtures to be generated ` 'fixturesAmount' => {count}` 
   in `/common/config/params-local.php` for `clients` and `companies`
7. Set max number of fixtures of client for each company ` 'maxCompanyCountForClient' => {count}`
   in `/common/config/params-local.php`
8. Run command `php fixture/load "*"`

### Api documentation
`/documentation` small documentation with Swagger

### Testing
Create db as main but with suffix `_test`

Update `/config/test-local.php` with own db credentials

Update `/api/test/api.suite.yaml`
    `url: 'http://<your_domain>/index-test.php'`

Run command `php yii_test migrate`

Run command `php codecept.phar run -c ./api`


