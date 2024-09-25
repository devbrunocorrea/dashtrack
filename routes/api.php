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

Route::get('/info', [MetricController::class, 'getInfo'])->name('api.info');
Route::get('/orders', [MetricController::class, 'getOrders'])->name('api.orders');
Route::get('/sellers', [MetricController::class, 'getSellers'])->name('api.sellers');
Route::get('/products', [MetricController::class, 'getProducts'])->name('api.products');
Route::get('/invoices', [MetricController::class, 'getInvoices'])->name('api.invoices');
