# Laravel News API Project

## Setup Instructions

```bash
git clone <repo-url>
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan queue:work
```
