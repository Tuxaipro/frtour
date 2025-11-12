<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Suppress PHP 8.5 deprecation warnings from vendor files only
// This must be set before Laravel bootstraps to catch config loading warnings
set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    // Only suppress E_DEPRECATED warnings from vendor files
    if ($errno === E_DEPRECATED && str_contains($errfile, '/vendor/')) {
        return true; // Suppress the warning
    }
    // Let other errors through
    return false;
}, E_DEPRECATED);

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
