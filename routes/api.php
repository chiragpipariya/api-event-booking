<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\AttendeeController;
use App\Http\Controllers\Api\BookingController;


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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Route::prefix('events')->group(function () {
//     Route::get('/', [EventController::class, 'index']);
//     Route::post('/', [EventController::class, 'store']);
//     Route::get('/{event}', [EventController::class, 'show']);
//     Route::put('/{event}', [EventController::class, 'update']);
//     Route::delete('/{event}', [EventController::class, 'destroy']);
// });
 
Route::apiResource('events', EventController::class);

Route::apiResource('attendees', AttendeeController::class);

Route::apiResource('bookings', BookingController::class);


