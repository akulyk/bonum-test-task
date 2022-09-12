#Test task Bonum Studio
РНР (YII2) developer

Goal - create a simple CRM system:
AdminLTE has to be used.
0. Enter to crm is provived by login and password
1. In CRM list of companies should be present. (ability to create, update and delete, all data should be validated).
2. In CRM list of company clients should be present (ability to create, update and delete, all data should be validated).
3. Clients in database should be connected with companies.
4. Tables should be described with migrations.
5. Tables should have a test data. (generate more then 10 thousands for each table)
6. Three rest api methods should be provided.
6.1 Companies - should return a company list in json format with ability to paginate
пагинации
6.2 Clients - accepts company ID, return list of clients json in json format with ability to paginate.
6.3 Client_companies - accepts client ID, return list of comanies connected with a client.
7. API should be protected by Bearer auth.
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


