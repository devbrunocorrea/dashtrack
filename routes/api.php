<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MetricController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware('auth:sanctum')->group(function () {
    Route::get('/info', [MetricController::class, 'getInfo'])->middleware(['auth'])->name('api.info');
    Route::get('/orders', [MetricController::class, 'getOrders'])->middleware(['auth'])->name('api.orders');
    Route::get('/products', [MetricController::class, 'getProducts'])->middleware(['auth'])->name('api.items');
    Route::get('/sellers', [MetricController::class, 'getSellers'])->middleware(['auth'])->name('api.sellers');
    Route::get('/products', [MetricController::class, 'getProducts'])->middleware(['auth'])->name('api.products');
    Route::get('/invoices', [MetricController::class, 'getInvoices'])->middleware(['auth'])->name('api.invoices');
// });
