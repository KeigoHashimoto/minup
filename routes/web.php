<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FixedCostsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/register',[App\Http\Controllers\RegisterController::class,'create'])
->middleware('guest')
->name('register');

Route::post('/register',[App\Http\Controllers\RegisterController::class,'store'])
->middleware('guest')
->name('register.post');

Route::get('/login',[App\Http\Controllers\LoginController::class,'index'])
->middleware('guest')
->name('login');

Route::post('/login',[App\Http\Controllers\LoginController::class,'authenticate'])
->middleware('guest')
->name('login.post');

Route::get('/logout',[App\Http\Controllers\LoginController::class,'logout'])
->middleware('auth')
->name('logout');

Route::group(['middleware'=>['auth']],function(){
    Route::get('/',[App\Http\Controllers\BudgetsController::class,'index'])->name('budget.index');
    Route::get('budget/create',[App\Http\Controllers\BudgetsController::class,'create'])->name('budget.create');
    Route::post('budget/store',[App\Http\Controllers\BudgetsController::class,'store'])->name('budget.store');
    Route::get('budget/{id}/show',[App\Http\Controllers\BudgetsController::class,'show'])->name('budget.show');
    Route::delete('budget/{id}/delete',[App\Http\Controllers\BudgetsController::class,'destroy'])->name('budget.delete');
    Route::get('budget/{id}/edit',[App\Http\Controllers\BudgetsController::class,'edit'])->name('budget.edit');
    Route::put('budget/{id}/update',[App\Http\Controllers\BudgetsController::class,'update'])->name('budget.update');
    Route::get('budget/month',[App\Http\Controllers\BudgetsController::class,'month'])->name('budget.month');
    Route::get('budget/month/{year}/{month}/show',[App\Http\Controllers\BudgetsController::class,'monthShow'])->name('budget.monthShow');
    Route::get('{id}/report',[App\Http\Controllers\BudgetsController::class,'report'])->name('budget.report');

    Route::post('expense/{budget}/store',[App\Http\Controllers\ExpensesController::class,'store'])->name('expenses.post');
    Route::delete('expense/{id}/delete',[App\Http\Controllers\ExpensesController::class,'destroy'])->name('expense.delete');
    Route::get('expense/{id}/edit',[App\Http\Controllers\ExpensesController::class,'edit'])->name('expense.edit');
    Route::put('expense/{id}/update',[App\Http\Controllers\ExpensesController::class,'update'])->name('expense.update');

    Route::post('/share',[App\Http\Controllers\ShareController::class,'share'])->name('share');
    Route::post('/shareRemove/{budgetId}',[App\Http\Controllers\ShareController::class,'shareRemove'])->name('shareRemove');

    //tasks
    Route::get('/tasks',[App\Http\Controllers\TasksController::class,'index'])->name('tasks.index');
    Route::post('/tasks/store',[App\Http\Controllers\TasksController::class,'store'])->name('task.post');
    Route::post('/tasks/{id}/status',[App\Http\Controllers\TasksController::class,'status'])->name('task.status');
    Route::delete('/tasks/{id}/delete',[App\Http\Controllers\TasksController::class,'destroy'])->name('task.delete');

    //fixedCosts
    Route::prefix('fixed-cost')->group(function() {
        Route::get('create-form',[FixedCostsController::class,'fixedCostCreate'])->name('fixedCreate.form');
        Route::post('store',[FixedCostsController::class,'fixedCostStore'])->name('fixedCost.store');
        Route::get('index',[FixedCostsController::class,'fixedCostindex'])->name('fixedCost.index');
        Route::post('delete-fixed-cost', [FixedCostsController::class, 'fixedCostDelete'])->name('fixedCost.delete');
    });
});