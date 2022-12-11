<?php

declare(strict_types=1);

use App\Http\Controllers\Api\Tenant\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Tenant\PageController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    'tenant'
])->group(function () {
    Route::get('/', function () {
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });
});


Route::middleware([
    'api',
    'tenant'
])->prefix('api')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::apiResource('pages', PageController::class);
    Route::middleware(['auth:user'])->prefix('user')->group(function () {
        Route::get('home', [App\Http\Controllers\Api\Tenant\User\HomeController::class, 'index']);
    });
    Route::middleware(['auth:admin'])->prefix('admin')->group(function () {

        Route::get('home', [App\Http\Controllers\Api\Tenant\Admin\HomeController::class, 'index']);

        //users 
        Route::get('users', [App\Http\Controllers\Api\Tenant\Admin\UserController::class, 'index']);
        Route::put('users/{user}', [App\Http\Controllers\Api\Tenant\Admin\UserController::class, 'update']);
    });
});
