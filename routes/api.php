<?php

use App\Http\Controllers\Admin\MailController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('companySearch', [App\Http\Controllers\Admin\CompanySearch::class, 'companySearch'])->name('companySearch');
Route::post('defaultSearch', [App\Http\Controllers\CompanySearch::class, 'defaultSearch'])->name('defaultSearch');
Route::post('defaultAdminSearch', [App\Http\Controllers\CompanySearch::class, 'defaultAdminSearch'])->name('defaultAdminSearch');
Route::post('mailFromAbout', [App\Http\Controllers\Admin\MailController::class, 'mailFromAbout'])->name('mailFromAbout');
