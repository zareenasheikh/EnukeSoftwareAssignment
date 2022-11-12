<?php
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
  use App\Http\Controllers\API\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
  
     
Route::middleware('auth:sanctum')->group( function () {

    Route::post('/auth/upload_img', [AuthController::class, 'uploadUserImg'])->name('upload_img');

});

Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);