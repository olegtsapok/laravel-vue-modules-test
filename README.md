Project description.
Laravel-11 + VueJS, php-8

Cel zadania:
Stwórz REST API umożliwiające defi niowanie i generowanie interaktywnych komponentów 
w postaci plików HTML, CSS i JS, 
które mogą być wielokrotnie wykorzystywane w projektach.


Deployment for Docker:
1. Clone project to your folder "git clone https://github.com/olegtsapok/laravel-vue-modules-test.git"
2. Go to project directory "cd laravel-vue-modules-test"
3. Create '.env' file from '.env.docker'
4. Start docker
5. Run 'docker compose build' to create container
5. Run 'docker compose up -d' to start container
6. Open container terminal and run migrations "php artisan migrate"
7. Now project is available by url "http://localhost:7000/"


Deployment localy:
1. Clone project to your folder "git clone https://github.com/olegtsapok/laravel-vue-modules-test.git"
2. Go to project directory "cd laravel-vue-modules-test"
3. Create '.env' file from '.env.sqlite'
4. Load vendors "composer install"
5. Create database and tables "php artisan migrate"
6. Install npm and build vuejs files "npm install && npm run build"
7. Run project as server "php artisan serve"
8. Now project is available by url "http://127.0.0.1:8000"


Steps for unit tests:
1. Create test database and tables "php artisan migrate --env=testing"
2. Run unit tests "php artisan test"