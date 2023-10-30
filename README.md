## Temples Family Clinic

## Prerequisites

- [Xampp](https://www.apachefriends.org/index.html) latest version v.3.3.0
- [Composer](https://getcomposer.org) latest version
- [NodeJs](https://nodejs.org/en/) latest version
- A Text Editor ([Sublime Text 3](https://www.sublimetext.com) preferred)
- Mailtrap Credentials
- PHP GD extension uncommented in PHP.ini file in Xampp PHP.ini configuration 

## Installation

Unzip the archive to `C:/xampp/htdocs`

Direct to your directory
```
cd templers
```
Run
```
composer install
```

Setup `.env` file

```
cp .env.example .env // on linux bash
copy .env.example .env // on windows
```

Generate the app key
```
php artisan key:generate
```

Create a database via `phpmyadmin` called `templers` and then seed your application
```
php artisan migrate --seed
```

Running the Website

- Start Xampp Apache and MYSQL
- Open a terminal window from project directory
	- Start development server by running `php artisan serve`
