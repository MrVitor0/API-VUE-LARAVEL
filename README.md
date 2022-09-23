# API Laravel / Vue.js

- Website Url - available until 05/09/2022
> https://crawly.elisyumcorp.com/

- How Works?
> Project containing API in PHP (Laravel), MVC and Clean Code standards, front-end in Vue.js with Bootstrap.

- Features
> - [x] Create/Delete Users
> - [x] Create/Delete Products
> - [x] Create/Delete Sells
> - [x] ViaCEP Integration
> - [x] CPF Validator


# How to setup?
- Create .env for Laravel and setup key
```shell
  cp .env.example .env
  php artisan key:generate
```
- Install composer dependencies
```shell
 composer install
```
- Install npm dependencies and compile
```shell
  npm install
  npm run dev
```
- Fill Database connection fields in .env

```env
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=x
  DB_USERNAME=x
  DB_PASSWORD=x
```

- Migrate tables

```env
  php artisan migrate
```

- Run

```env
  php artisan serve
```



