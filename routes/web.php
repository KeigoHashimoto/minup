<?php

use Illuminate\Support\Facades\Route;

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
    Route::get('budget/month',[App\Http\Controllers\BudgetsController::class,'month'])->name('budget.month');
    Route::get('budget/month/{newMonth}/show',[App\Http\Controllers\BudgetsController::class,'monthShow'])->name('budget.monthShow');

    Route::post('expense/{budget}/store',[App\Http\Controllers\ExpensesController::class,'store'])->name('expenses.post');
    Route::delete('expence/{id}/delete',[App\Http\Controllers\ExpensesController::class,'destroy'])->name('expense.delete');

});