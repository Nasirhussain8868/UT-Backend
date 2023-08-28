<?php

use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/loggeduser', [UserController::class, 'loggeduser']);
    Route::get('/logout', [UserController::class, 'logout']);
});
Route::get('/view',[TicketController::class, 'ticketView']);
Route::post('/upload-csv',[TicketController::class, 'uploadCsv']);
Route::get('/tickets-delete_all', [TicketController::class, 'deleteAll']);
Route::post('/tickets-update', [TicketController::class, 'updateMainComments']);
Route::post('/login', [UserController::class, 'login']);
