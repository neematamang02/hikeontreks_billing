#!/bin/bash
set -e

# Render injects a $PORT env var (defaults to 10000 if not set) — Apache must listen on it.
PORT="${PORT:-10000}"
sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf
sed -ri "s/:80/:${PORT}/g" /etc/apache2/sites-available/*.conf

cd /var/www/html

# Create .env if it doesn't exist (first boot without mounted env)
if [ ! -f .env ]; then
    echo "No .env file found — creating from defaults..."
    touch .env
    [ -n "$APP_KEY" ] && echo "APP_KEY=$APP_KEY" >> .env
    [ -n "$APP_ENV" ] && echo "APP_ENV=$APP_ENV" >> .env || echo "APP_ENV=production" >> .env
    [ -n "$APP_DEBUG" ] && echo "APP_DEBUG=$APP_DEBUG" >> .env || echo "APP_DEBUG=false" >> .env
    [ -n "$APP_URL" ] && echo "APP_URL=$APP_URL" >> .env
    [ -n "$DB_CONNECTION" ] && echo "DB_CONNECTION=$DB_CONNECTION" >> .env || echo "DB_CONNECTION=mysql" >> .env
    [ -n "$DB_HOST" ] && echo "DB_HOST=$DB_HOST" >> .env
    [ -n "$DB_PORT" ] && echo "DB_PORT=$DB_PORT" >> .env || echo "DB_PORT=3306" >> .env
    [ -n "$DB_DATABASE" ] && echo "DB_DATABASE=$DB_DATABASE" >> .env
    [ -n "$DB_USERNAME" ] && echo "DB_USERNAME=$DB_USERNAME" >> .env
    [ -n "$DB_PASSWORD" ] && echo "DB_PASSWORD=$DB_PASSWORD" >> .env
    echo "SESSION_DRIVER=file" >> .env
    echo "CACHE_DRIVER=file" >> .env
    echo "QUEUE_CONNECTION=sync" >> .env
fi

# Generate an APP_KEY on first boot if one wasn't supplied via env vars
if [ -z "$APP_KEY" ]; then
    echo "No APP_KEY set - generating one..."
    php artisan key:generate --force
fi

# Wait for database to be reachable (up to 60 seconds)
if [ "$DB_HOST" != "localhost" ] && [ "$DB_HOST" != "127.0.0.1" ]; then
    echo "Waiting for database at $DB_HOST:$DB_PORT..."
    RETRIES=30
    until php artisan db:show > /dev/null 2>&1 || [ $RETRIES -eq 0 ]; do
        RETRIES=$((RETRIES - 1))
        echo "  Database not ready, retrying in 2s... ($RETRIES attempts left)"
        sleep 2
    done
    if [ $RETRIES -eq 0 ]; then
        echo "WARNING: Could not connect to database after 60s. Starting anyway..."
    else
        echo "Database connection established."
    fi
fi

# Clear any stale cached config from the image build (paths/keys differ at runtime)
php artisan config:clear || true
php artisan route:clear || true
php artisan view:clear || true

# Run pending migrations against the configured database
if [ "$RUN_MIGRATIONS" != "false" ]; then
    echo "Running migrations..."
    php artisan migrate --force 2>&1 || echo "WARNING: Migration failed - check DB connectivity/credentials"
fi

# Re-cache for production performance
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

# Make sure storage symlink exists (for public file uploads)
php artisan storage:link || true

exec "$@"
