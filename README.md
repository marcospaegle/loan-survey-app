## About this project
A little demo application for loan survey where you can configure dynamic rules for the survey validation.

## How to use it
- Clone the repo;
- Run composer install;
- Copy the .env.example to .env;
- Run "php artisan key:generate";
- Configure your database in .env file;
- Run "php artisan migrate:fresh --seed";
- Run "php artisan test";

## How to play
Open the ./tests/Unit/SurveyServiceTest.php and change or create new tests.
