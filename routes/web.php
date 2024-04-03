<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestCompanyDBController;

Route::post('/company', [TestCompanyDBController::class, 'store']);

