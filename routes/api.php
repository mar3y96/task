<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Centrall\MasterController;


Route::post('create-tenant', [MasterController::class, 'store']);
