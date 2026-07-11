# HikeOnTreks Billing - cPanel Deployment Guide

## Prerequisites

- PHP 8.0+ (check via cPanel > Select PHP Version)
- MySQL database created in cPanel
- Composer (will be installed on server if missing)

## Step 1: Prepare the Build (Local Machine)

```bash
chmod +x deploy.sh
./deploy.sh
```

This creates a zip file at `/tmp/billing_YYYYMMDD_HHMMSS.zip` with:
- Production `.env` (you'll edit this on the server)
- Optimized autoloader (if composer is available locally)
- No `.git`, `node_modules`, dev files, or logs

## Step 2: Create MySQL Database (cPanel)

1. Go to **cPanel > MySQL Databases**
2. Create a new database: `yourprefix_billing`
3. Create a new user with a strong password
4. **Add the user to the database** with **ALL PRIVILEGES**
5. Note down: database name, username, and password

## Step 3: Upload Files (cPanel File Manager)

### Option A: Upload zip via File Manager (No SSH)

1. Open **cPanel > File Manager**
2. Navigate to your **home directory** (`/home/username/`)
3. Click **Upload** and upload the `billing_*.zip` file
4. After upload, right-click the zip > **Extract** to `/home/username/`
5. The files will be in `/home/username/billing/`

### Option B: Upload zip via SSH (Recommended)

```bash
scp billing_*.zip username@yourserver:~/
ssh username@yourserver
```

## Step 4: Setup the Server

### If you have SSH access:

```bash
cd ~
bash setup-billing-server.sh
```

This will:
- Extract files to `~/billing/`
- Symlink `~/public_html` -> `~/billing/public`
- Install composer dependencies
- Generate APP_KEY
- Run migrations
- Cache config/routes/views

### If you DON'T have SSH access (cPanel File Manager only):

Follow these manual steps:

#### 4a. Move files into place

In File Manager, after extracting the zip:

1. You should see `/home/username/billing/` with all Laravel directories
2. Navigate to `billing/public/` - copy ALL contents from here

#### 4b. Set up public_html

1. Go to `public_html/` directory
2. **Delete** the default `cgi-bin/` folder if present
3. **Copy** all files from `billing/public/` into `public_html/`

#### 4c. Modify public_html/index.php

Edit `public_html/index.php` and change these two lines:

```php
// FROM:
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

// TO (adjust 'username' to your cPanel username):
require __DIR__.'/../billing/vendor/autoload.php';
$app = require_once __DIR__.'/../billing/bootstrap/app.php';
```

Also change the maintenance mode check:
```php
// FROM:
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {

// TO:
if (file_exists($maintenance = __DIR__.'/../billing/storage/framework/maintenance.php')) {
```

Or simply use the pre-built file: copy `deploy/cpanel-index.php` to `public_html/index.php`.

## Step 5: Configure .env

Edit `~/billing/.env` via File Manager or SSH:

```ini
APP_NAME=HikeOnTreks|Billing
APP_ENV=production
APP_KEY=                    # Will be generated later
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=yourprefix_billing      # From Step 2
DB_USERNAME=yourprefix_dbuser       # From Step 2
DB_PASSWORD=your_db_password        # From Step 2

SESSION_DRIVER=file
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
```

**IMPORTANT:** Remove any trailing spaces or quotes around values.

## Step 6: Generate APP_KEY

### Via SSH:
```bash
cd ~/billing
php artisan key:generate --force
```

### Via cPanel Terminal (if available):
Same command as above.

### No terminal access?
Manually generate a key:
1. Go to https://laravel.com/docs/8.x/configuration#determining-the-application-key
2. Or run `php artisan key:generate` locally, then copy the `APP_KEY` value from your local `.env` to the server `.env`

## Step 7: Set Permissions

### Via SSH:
```bash
chmod -R 755 ~/billing/storage
chmod -R 755 ~/billing/bootstrap/cache
chmod 644 ~/billing/.env
```

### Via File Manager:
Right-click folders > **Change Permissions**:
- `storage/` and all subdirectories: **755**
- `bootstrap/cache/`: **755**
- `.env`: **600** (owner only)

## Step 8: Create Admin User

### Via SSH:
```bash
cd ~/billing
php artisan tinker
```
```php
\App\Models\User::create([
    'name' => 'Admin',
    'email' => 'admin@yourdomain.com',
    'password' => bcrypt('YourSecurePassword123!'),
    'role' => 'admin',
]);
exit;
```

### Via cPanel MySQL (phpMyAdmin):
1. Open **phpMyAdmin**
2. Select your database
3. Go to the `users` table > **Insert**
4. Fill in:
   - `name`: Admin
   - `email`: admin@yourdomain.com
   - `password`: Run `php -r "echo password_hash('YourSecurePassword123!', PASSWORD_BCRYPT);"` locally and paste the hash
   - `role`: admin
   - `created_at` and `updated_at`: current timestamp

## Step 9: Run Migrations

### Via SSH:
```bash
cd ~/billing
php artisan migrate --force
```

### No SSH access?
The migrations must be run. Options:
1. Ask your hosting provider to run `php artisan migrate --force`
2. Import the SQL manually via phpMyAdmin (create tables from the migration files)
3. Use cPanel's **Terminal** app if available

## Step 10: Optimize (Optional but Recommended)

```bash
cd ~/billing
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Step 11: Verify

1. Visit `https://yourdomain.com`
2. You should be redirected to `/login`
3. Log in with the admin credentials from Step 8

---

## Troubleshooting

### 500 Internal Server Error
- Check `~/billing/storage/logs/laravel.log`
- Ensure `.env` has a valid `APP_KEY`
- Verify permissions: `storage/` and `bootstrap/cache/` must be writable (755)
- Check PHP version is 8.0+

### "Class not found" errors
```bash
cd ~/billing
composer dump-autoload
composer install --no-dev --optimize-autoloader
```

### Database connection failed
- Verify DB_DATABASE, DB_USERNAME, DB_PASSWORD in `.env`
- Ensure the database user has ALL PRIVILEGES on the database
- Some hosts require `127.0.0.1` instead of `localhost` for DB_HOST

### Assets not loading (CSS/JS 404)
- Verify `public_html` points to `billing/public/`
- Check `.htaccess` exists in `public_html/`
- Ensure mod_rewrite is enabled (contact hosting provider)

### Session/login issues
```bash
cd ~/billing
chmod -R 777 storage/framework/sessions
chmod -R 777 storage/framework/views
chmod -R 777 storage/framework/cache
php artisan cache:clear
php artisan config:clear
```

### PHP version mismatch
Go to **cPanel > Select PHP Version** and ensure PHP 8.0+ is selected.

---

## File Structure on Server

```
/home/username/
├── public_html/              ← Web root (symlink to billing/public)
│   └── -> billing/public/    ← Symlink
├── billing/                  ← Laravel app (OUTSIDE web root)
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── database/
│   ├── public/               ← Laravel public dir
│   │   ├── index.php
│   │   ├── .htaccess
│   │   ├── css/
│   │   ├── js/
│   │   └── assets/
│   ├── resources/
│   ├── routes/
│   ├── storage/
│   ├── vendor/
│   └── .env                  ← Environment config (NOT web-accessible)
└── .bashrc
```

## Quick Reference Commands

```bash
# SSH into server
ssh username@yourdomain.com

# Navigate to app
cd ~/billing

# View logs
tail -f storage/logs/laravel.log

# Clear all caches
php artisan cache:clear && php artisan config:clear && php artisan route:clear && php artisan view:clear

# Re-cache for production
php artisan config:cache && php artisan route:cache && php artisan view:cache

# Run migrations
php artisan migrate --force

# Create admin user
php artisan tinker
```
