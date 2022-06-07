<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Install project 
Clone the project
```bash
git clone https://github.com/viaigor7/601395.git
```

Updating packages
```bash
composer install
```

Copy file with name change
```bash
cp .env.example .env
```

Сreate a key
```bash
php artisan key:generate
```

Creating tables in the database
```bash
php artisan migrate
```

Generating records in the database
```bash
php artisan migrate:fresh --seed
```

or
```bash
php artisan migrate:fresh --seed
```
