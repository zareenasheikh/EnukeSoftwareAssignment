<?php
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
  
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
  
     
Route::middleware('auth:sanctum')->group( function () {


});

    Route::post('/upload_img', [App\Http\Controllers\API\AuthController::class, 'store'])->name('upload_img');
