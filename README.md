#### PREREQUISITES:
- PHP 8+
- GIT https://git-scm.com/downloads
- Composer https://getcomposer.org/download/
- NodeJS/NPM https://nodejs.org/en/download/

#### GUIDE TO SETUP THE PROJECT:
- Copy the .env.example file and rename it to the .env file (modify database and mail config first)
- Execute the command `composer install` to insall the project dependencies
- Execute the command `php artisan key:generate` to generate environment app key
- Execute the command `php artisan migrate` to run the database migrations
- Execute the command `npm install` to insall the (front) project dependencies
- Execute the command `npm run build` to build the UI
- Execute the command `php artisan serve`

Go to http://127.0.0.1:8000/
