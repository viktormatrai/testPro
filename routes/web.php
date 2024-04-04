<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestCompanyDBController;

Route::post('/company', [TestCompanyDBController::class, 'store']);
Route::get('/company/{companyId}', [TestCompanyDBController::class, 'show']);
Route::put('/company/{companyId}', [TestCompanyDBController::class, 'update']);
Route::delete('/company/{companyId}', [TestCompanyDBController::class, 'destroy']);
