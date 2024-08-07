<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BillController;

Route::get('/bill', [BillController::class, 'index']);
Route::post('/calculate', [BillController::class, 'calculate']);

