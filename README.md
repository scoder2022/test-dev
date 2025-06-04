# Laravel News API

-   CRUD operations for news articles
-   Multi-language and multi-country support
-   Caching to improve performance
-   Event and listener system to log actions when news is created or updated
-   Background job that simulates sharing news on social media

## API Usage

All endpoints require two headers:

-   `x-lang-code` (e.g. `en`)
-   `x-country-code` (e.g. `us`)

### Available API endpoints:

-   `GET /api/news` – List all news
-   `GET /api/news/{id}` – Show a single news item
-   `POST /api/news` – Create a new news item
-   `PUT /api/news/{id}` – Update an existing news item
-   `DELETE /api/news/{id}` – Delete a news item

## Setup Instructions

1. Clone the repository
2. Run `composer install`
3. Copy `.env.example` to `.env` and configure database
4. Run `php artisan key:generate`
5. Run migrations: `php artisan migrate`
6. Start queue worker: `php artisan queue:work`
