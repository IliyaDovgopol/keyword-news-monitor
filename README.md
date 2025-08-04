Вот переведённый и адаптированный на английский `README.md`:

---

````markdown
 Keyword News Monitor

Keyword News Monitor is a Laravel-based project that monitors news from RSS feeds based on user-defined keywords. The system automatically imports news, saves matching items to the database, logs search activity, and provides API access to the data.

 Technologies

- Laravel 11
- PHP 8.3
- MySQL
- Docker (Laravel Sail)
- Feed-io (for parsing RSS)
- Carbon
- Planned: Swagger (L5-Swagger), queues, caching, authentication (if needed)

 Getting Started

```bash
git clone git@github.com:IliyaDovgopol/keyword-news-monitor.git
cd keyword-news-monitor

 Install dependencies
./vendor/bin/sail up -d
./vendor/bin/sail composer install

 Copy env and run migrations
cp .env.example .env
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate
````

 Project Structure & Development Plan

 Phase 1: Project Setup

 Laravel & Docker (Sail) installation
 .env environment configuration
 Planned: Basic Swagger documentation

 Phase 2: Architecture & Models

 Models and migrations created:

   `Keyword` – keyword list
   `Feed` – RSS sources
   `News` – collected news
   `SearchLog` – keyword/feed search logs
 Relationships established between models

 Phase 3: Core Logic

 RSS feeds are imported via cron
 News is matched against keywords
 Matching news items are stored in the database
 Search logs are created

 Phase 4: Queues & Caching (planned)

 News import in the background using queues
 Cache frequently requested data (e.g. latest news)

 Phase 5: API & Documentation (planned)

 Routes:

   `GET /keywords`
   `POST /keywords`
   `GET /news`
   `GET /news/{id}`
 L5-Swagger integration for API documentation

 Phase 6: Statistics (planned)

 Number of news items per keyword
 Frequency of news appearances
 Charts/graphs via API or Chart.js

 Phase 7: Testing (planned)

 Unit tests for import and search services
 Feature tests for API endpoints

 Phase 8: Deployment & Finalization (planned)

 `docker-compose.prod.yml` for production (optional)
 Final README.md and documentation
 Demo (video or screenshots)

 Development Status

Project is under active development. Suggestions and pull requests are welcome.

