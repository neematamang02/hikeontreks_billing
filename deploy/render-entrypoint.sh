#!/bin/bash
set -e

# Render injects a $PORT env var (defaults to 10000 if not set) — Apache must listen on it.
PORT="${PORT:-10000}"
sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf
sed -ri "s/:80/:${PORT}/g" /etc/apache2/sites-available/*.conf

cd /var/www/html

# Generate an APP_KEY on first boot if one wasn't supplied via env vars
if [ -z "$APP_KEY" ]; then
    echo "No APP_KEY set - generating one..."
    php artisan key:generate --force
fi

# Clear any stale cached config from the image build (paths/keys differ at runtime)
php artisan config:clear || true
php artisan route:clear || true
php artisan view:clear || true

# Run pending migrations against the configured database
if [ "$RUN_MIGRATIONS" != "false" ]; then
    echo "Running migrations..."
    php artisan migrate --force || echo "Migration failed - check DB connectivity/credentials"
fi

# Re-cache for production performance
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Make sure storage symlink exists (for public file uploads)
php artisan storage:link || true

exec "$@"
