# ---- Stage 1: build frontend assets (webpack mix) ----
FROM node:18-alpine AS frontend
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm install
COPY resources ./resources
COPY webpack.mix.js ./
RUN npm run production

# ---- Stage 2: PHP application image ----
FROM php:8.1-apache

# System packages + PHP extensions Laravel needs
RUN apt-get update && apt-get install -y \
        git unzip zip curl libzip-dev libpng-dev libonig-dev libxml2-dev libicu-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip intl opcache \
    && a2enmod rewrite \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Install PHP deps first (better layer caching)
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist --no-interaction

# Copy the rest of the app
COPY . .

# Bring in compiled frontend assets from stage 1
COPY --from=frontend /app/public/js ./public/js
COPY --from=frontend /app/public/css ./public/css
COPY --from=frontend /app/public/mix-manifest.json ./public/mix-manifest.json

RUN composer dump-autoload --optimize --no-dev \
    && mkdir -p storage/framework/{sessions,views,cache} storage/logs bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Apache: serve from /public, and listen on Render's $PORT at runtime
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!AllowOverride None!AllowOverride All!g' /etc/apache2/apache2.conf

COPY deploy/render-entrypoint.sh /usr/local/bin/render-entrypoint.sh
RUN chmod +x /usr/local/bin/render-entrypoint.sh

EXPOSE 10000
ENTRYPOINT ["render-entrypoint.sh"]
CMD ["apache2-foreground"]
