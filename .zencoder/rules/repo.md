# Project Overview
- **Framework**: Laravel application running on PHP 8.2 with Apache
- **Use Case**: Web application deployed via Docker container
- **Entry Point**: `php artisan serve` in Dockerfile exposing port 8080

# Tech Stack & Dependencies
- **Runtime Image**: `php:8.2-apache`
- **Composer**: Copied from `composer:2` image
- **System Packages**: `git`, `unzip`, `libzip-dev`
- **PHP Extensions**: `zip` (SQLite already bundled with base image)

# Repository Structure (Key Paths)
- `/Dockerfile`: Defines build and runtime steps for Render deployment
- `/database/database.sqlite`: SQLite database file created during Docker build
- `/storage/logs/laravel.log`: Primary location for Laravel error logs

# Local Development
1. Copy `.env.example` to `.env` and configure local environment variables (especially `APP_KEY` and database settings).
2. Run `composer install`.
3. Generate encryption key: `php artisan key:generate`.
4. Ensure `storage`, `bootstrap/cache`, and `database` directories are writable.
5. Serve locally with `php artisan serve` (default `127.0.0.1:8000`).

# Docker Build & Runtime Notes
1. Dockerfile installs only the `zip` extension because SQLite ships with `php:8.2-apache`.
2. Composer global repo config is reset to official Packagist mirror for reliable dependency resolution.
3. `composer install --no-dev --optimize-autoloader` runs during build.
4. SQLite database file is created (`touch database/database.sqlite`) and permissions for `storage`, `bootstrap/cache`, and `database` are set to `775`.
5. Container command runs `php artisan serve --host=0.0.0.0 --port=8080`.

# Render Deployment Guide
1. **Service Type**: Web Service pointing to Dockerfile in repository root.
2. **Build Command**: Managed by Dockerfile (no extra command needed).
3. **Start Command**: Already defined in Dockerfile; leave Render start command empty.
4. **Ports**: Render automatically maps container port `8080` to public HTTP.

## Required Environment Variables on Render
- `APP_KEY`: Set using `php artisan key:generate --show` (copy the `base64:...` string).
- `APP_ENV`: Typically `production`.
- `APP_DEBUG`: `false`.
- `APP_URL`: Public URL provided by Render.
- `DB_CONNECTION`: `sqlite`.
- `DB_DATABASE`: Absolute path `/var/www/html/database/database.sqlite`.

## Optional/Additional Variables
- Configure mail, queue, cache, or third-party integrations as needed.
- If using other persistent storage, adjust Dockerfile and env vars accordingly.

# Troubleshooting Checklist
- **HTTP 500 after deploy**: Check `storage/logs/laravel.log` via Render shell. Missing `APP_KEY` is the most common cause.
- **Database errors**: Confirm SQLite file exists and `DB_DATABASE` path matches `/var/www/html/database/database.sqlite`.
- **Permission issues**: Ensure directories `storage`, `bootstrap/cache`, and `database` remain writable (handled in Dockerfile but verify on rebuilds).
- **Config cache**: If `config:cache` was run locally, clear it (`php artisan config:clear`) before building to avoid stale environment values.

# Notes
- Keep secrets (API keys, DB credentials) in Render environment variables, not in the repository.
- Rebuild and redeploy whenever `.env`-related settings change to pick up new values within the container.