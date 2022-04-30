# Welcome to webstock!

This is the web based application which can capble to maange stocks. Currently under developing by **websolcr**.

### Setup the project on local machine

clone the repository.

Copy `.env.example` to `.env`.

Generate application key.
>php artisan key:generate

Create database `webstock` for application.
Create database `webstock_test` for testing purposes.

Set database credentials in `.env`

Migrate the database,
>php artisan migrate:seed

Migrate the test database
>php artisan migrate:fresh --database=mysql_test

Install node modules from project root.
>npm install

Change directory to `/resourses/frontend`.
Install node modules.
>npm install

Serve the frontend application
>npm run build.
