<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FixedCostsController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\ApiController;

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
Route::middleware('auth:sanctum')->group(function() {
    Route::get('/get-costs',[FixedCostsController::class,'getCosts']);
    Route::post('/post-fixed-cost-expenses', [ExpensesController::class, 'fixedCostExpensesStore']);
});

Route::post('/post-budget', [ApiController::class, 'apiBudgetRegister']);
Route::post('/post-expense', [ApiController::class, 'apiExpensesRegister']);
Route::post('/share', [ApiController::class, 'shareApi']);

