<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;



Route::get('', [FrontController::class, 'index']);
Route::get('download-documents', [FrontController::class, 'downloadDocuments']);
Route::get('user-login', [FrontController::class, 'userLoginView']);
Route::post('user-login', [FrontController::class, 'userLogin']);
Route::get('user-logout', [FrontController::class, 'userLogout']);
