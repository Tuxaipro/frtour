<?php

// Increase PHP limits that can be set at runtime
@ini_set('memory_limit', '256M');
// Set max_execution_time to 0 (unlimited) for CLI commands, 300 for web requests
if (php_sapi_name() === 'cli') {
    @ini_set('max_execution_time', '0');
    @set_time_limit(0);
} else {
@ini_set('max_execution_time', '300');
}
@ini_set('max_input_time', '300');

// Suppress PHP 8.5 deprecation warnings from vendor files only
// This allows us to still catch deprecations in our own code
set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    // Only suppress E_DEPRECATED warnings from vendor files
    if ($errno === E_DEPRECATED && str_contains($errfile, '/vendor/')) {
        return true; // Suppress the warning
    }
    // Let other errors through
    return false;
}, E_DEPRECATED);

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
