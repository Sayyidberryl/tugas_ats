<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CostController;
use App\Http\Controllers\IncomeController;


Route::get('/', [CostController::class, 'index'])->name('cost');
Route::get('/costs/add', [CostController::class, 'create'])-> name('cost.add');
Route::post('/costs/add', [CostController::class, 'store'])-> name('cost.add.store');
Route::delete('/costs/delete/{id}', [CostController::class, 'destroy'])-> name('cost.delete');
Route::get('/costs/edit/{id}', [CostController::class, 'edit'])-> name('cost.edit');
Route::patch('/costs/edit/{id}', [CostController::class, 'update'])-> name('cost.edit.update');

//income
Route::get('/incomes', [IncomeController::class, 'index'])->name('income');
Route::get('/incomes/add', [IncomeController::class, 'create'])-> name('income.add');
Route::post('/incomes/add', [IncomeController::class, 'store'])-> name('income.add.store');
Route::delete('/incomes/delete/{id}', [IncomeController::class, 'destroy'])-> name('income.delete');
Route::get('/incomes/edit/{id}', [IncomeController::class, 'edit'])-> name('income.edit');
Route::patch('/incomes/edit/{id}', [IncomeController::class, 'update'])-> name('income.edit.update');