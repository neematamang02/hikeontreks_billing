<?php

/**
 * ============================================================
 * HikeOnTreks Billing - cPanel Deployment Index
 * ============================================================
 *
 * USE THIS FILE ONLY if symlinks are NOT supported on your hosting.
 *
 * Deploy options:
 *
 * OPTION A (Recommended): Symlink public_html -> billing/public
 *   - Use the DEFAULT public/index.php (no changes needed)
 *   - Run: ln -sfn ~/billing/public ~/public_html
 *
 * OPTION B: Copy this file to public_html/index.php
 *   - Place your Laravel app in ~/billing/
 *   - Copy this file to ~/public_html/index.php
 *   - This file manually points to the billing directory
 *
 * ============================================================
 */

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../billing/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../billing/vendor/autoload.php';

// Bootstrap Laravel and handle the request...
$app = require_once __DIR__.'/../billing/bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);
