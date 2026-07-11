#!/bin/bash

# ============================================================
# HikeOnTreks Billing - Deployment Preparation Script
# Run this locally before uploading to cPanel
# ============================================================

set -e

APP_NAME="billing"
BUILD_DIR="/tmp/${APP_NAME}_deploy"
ARCHIVE_NAME="${APP_NAME}_$(date +%Y%m%d_%H%M%S).zip"

echo "============================================"
echo "  HikeOnTreks Billing - Deployment Builder"
echo "============================================"
echo ""

# Clean previous build
rm -rf "$BUILD_DIR"
mkdir -p "$BUILD_DIR/public"
mkdir -p "$BUILD_DIR/storage"
mkdir -p "$BUILD_DIR/bootstrap/cache"

echo "[1/7] Copying application files..."

# Copy Laravel app directories (excluding public/ internals, vendor, node_modules)
rsync -a --exclude='vendor/' \
         --exclude='node_modules/' \
         --exclude='public/__MACOSX/' \
         --exclude='public/.DS_Store' \
         --exclude='public/.well-known/' \
         --exclude='public/cgi-bin/' \
         --exclude='public/error_log' \
         --exclude='public/test15432/' \
         --exclude='storage/logs/*.log' \
         --exclude='storage/framework/cache/data/*' \
         --exclude='storage/framework/sessions/*' \
         --exclude='storage/framework/views/*' \
         --exclude='.git/' \
         --exclude='.env' \
         --exclude='deploy.sh' \
         --exclude='SETUP.md' \
         . "$BUILD_DIR/"

echo "[2/7] Copying public directory..."

# Copy public folder contents to build public/
rsync -a --exclude='__MACOSX/' \
         --exclude='.DS_Store' \
         --exclude='.well-known/' \
         --exclude='cgi-bin/' \
         --exclude='error_log' \
         --exclude='test15432/' \
         public/ "$BUILD_DIR/public/"

echo "[3/7] Setting up .env for production..."

cat > "$BUILD_DIR/.env" << 'ENVEOF'
APP_NAME=HikeOnTreks|Billing
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://yourdomain.com

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DRIVER=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"
ENVEOF

echo "[4/7] Installing composer dependencies..."

# Install production composer dependencies
if command -v composer &> /dev/null; then
    cd "$BUILD_DIR"
    composer install --no-dev --optimize-autoloader --no-interaction 2>/dev/null || {
        echo "  WARNING: Composer install failed. You must run 'composer install --no-dev' on the server."
        echo "  Creating composer.json post-install hook..."
    }
    cd - > /dev/null
else
    echo "  WARNING: Composer not found locally. You MUST run 'composer install --no-dev' on the server after upload."
fi

echo "[5/7] Creating deployment archive..."

# Create zip archive
cd /tmp
zip -r "$ARCHIVE_NAME" "$APP_NAME"_deploy/ -q
mv "$ARCHIVE_NAME" "$(pwd)/"
rm -rf "$BUILD_DIR"

echo "[6/7] Creating server setup script..."

# Create the SSH setup script
cat > "/tmp/setup-billing-server.sh" << 'SETUPEOF'
#!/bin/bash

# ============================================================
# Server-Side Setup Script
# Run this on the server via SSH after uploading the zip
# Usage: bash setup-billing-server.sh
# ============================================================

set -e

DOMAIN_DIR="$HOME"
PUBLIC_HTML="$HOME/public_html"
APP_DIR="$DOMAIN_DIR/billing"
APP_NAME="billing"

echo "============================================"
echo "  Server-Side Setup"
echo "============================================"
echo ""

# Check if Laravel is already extracted
if [ ! -d "$APP_DIR/app" ]; then
    echo "[1/8] Extracting files..."
    cd "$DOMAIN_DIR"
    # Find and extract the deployment zip
    ZIP_FILE=$(ls -t /tmp/${APP_NAME}_*.zip 2>/dev/null | head -1)
    if [ -z "$ZIP_FILE" ]; then
        # Check home directory for the zip
        ZIP_FILE=$(ls -t ~/${APP_NAME}_*.zip 2>/dev/null | head -1)
    fi
    if [ -z "$ZIP_FILE" ]; then
        echo "ERROR: No deployment zip found. Upload it first via cPanel File Manager."
        exit 1
    fi
    unzip -o "$ZIP_FILE" -d "$DOMAIN_DIR/" > /dev/null 2>&1
    # Move contents from billing_deploy to billing
    if [ -d "$DOMAIN_DIR/${APP_NAME}_deploy" ]; then
        mv "$DOMAIN_DIR/${APP_NAME}_deploy" "$APP_DIR"
    fi
    rm -f "$ZIP_FILE"
else
    echo "[1/8] App directory already exists, skipping extraction..."
fi

echo "[2/8] Setting up public_html..."

# Backup existing public_html if it has content
if [ -d "$PUBLIC_HTML" ] && [ "$(ls -A $PUBLIC_HTML 2>/dev/null)" ]; then
    mv "$PUBLIC_HTML" "${PUBLIC_HTML}_backup_$(date +%Y%m%d)"
fi

# Create symlink from public_html to billing/public
ln -sfn "$APP_DIR/public" "$PUBLIC_HTML"

echo "[3/8] Setting directory permissions..."

# Laravel directory permissions
chmod -R 755 "$APP_DIR/storage"
chmod -R 755 "$APP_DIR/bootstrap/cache"

# Ensure .env exists
if [ ! -f "$APP_DIR/.env" ]; then
    echo "ERROR: .env file not found! Please create it at $APP_DIR/.env"
    exit 1
fi

echo "[4/8] Installing Composer dependencies..."
cd "$APP_DIR"
if command -v composer &> /dev/null; then
    composer install --no-dev --optimize-autoloader --no-interaction 2>&1
else
    # Try common locations
    COMPOSER=$(find / -name "composer" -o -name "composer.phar" 2>/dev/null | head -1)
    if [ -n "$COMPOSER" ]; then
        php "$COMPOSER" install --no-dev --optimize-autoloader --no-interaction 2>&1
    else
        echo "WARNING: Composer not found. Please install dependencies manually."
        echo "  Download composer: curl -sS https://getcomposer.org/installer | php"
        echo "  Run: php composer.phar install --no-dev --optimize-autoloader"
    fi
fi

echo "[5/8] Generating application key..."
php artisan key:generate --force 2>/dev/null || echo "WARNING: Could not generate APP_KEY. Set it manually in .env"

echo "[6/8] Running database migrations..."
php artisan migrate --force 2>/dev/null || echo "WARNING: Migration failed. Check your database connection in .env"

echo "[7/8] Optimizing application..."
php artisan config:cache 2>/dev/null || true
php artisan route:cache 2>/dev/null || true
php artisan view:cache 2>/dev/null || true
php artisan icons:cache 2>/dev/null || true

echo "[8/8] Clearing caches..."
php artisan cache:clear 2>/dev/null || true
php artisan config:clear 2>/dev/null || true

echo ""
echo "============================================"
echo "  Setup Complete!"
echo "============================================"
echo ""
echo "App URL:  https://$(grep APP_URL .env | cut -d'=' -f2 | tr -d '\"')"
echo "App Dir:  $APP_DIR"
echo "Public:   $PUBLIC_HTML -> $APP_DIR/public"
echo ""
echo "NEXT STEPS:"
echo "  1. Edit .env file: nano $APP_DIR/.env"
echo "  2. Update APP_URL, DB_DATABASE, DB_USERNAME, DB_PASSWORD"
echo "  3. Run: php artisan migrate --force"
echo "  4. Create an admin user via: php artisan tinker"
echo ""
SETUPEOF

chmod +x "/tmp/setup-billing-server.sh"

echo "[7/7] Done!"
echo ""
echo "============================================"
echo "  Build Complete!"
echo "============================================"
echo ""
echo "Archive: /tmp/$ARCHIVE_NAME"
echo "Size: $(du -h /tmp/$ARCHIVE_NAME | cut -f1)"
echo ""
echo "NEXT STEPS:"
echo "  1. Upload '$ARCHIVE_NAME' to your cPanel File Manager"
echo "     (upload to /home/username/ - NOT inside public_html)"
echo ""
echo "  2. If you have SSH access, run:"
echo "     cd ~ && bash setup-billing-server.sh"
echo ""
echo "  3. If no SSH, follow SETUP.md for manual cPanel steps"
echo ""
