<?php

use Illuminate\Support\Facades\Route;
use App\Models\Beneficiary;
use App\Http\Controllers\BeneficiaryController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/beneficiaries/no-cache', [BeneficiaryController::class, 'getActiveBeneficiariesSansCache']);
Route::get('/beneficiaries/with-cache', [BeneficiaryController::class, 'getActiveBeneficiariesWithCache']);
Route::put('/beneficiaries/{id}', [BeneficiaryController::class, 'updateBeneficiaryInvalidateCache']);
Route::get('/beneficiaries/performance', [BeneficiaryController::class, 'comparePerformance']);


Route::get('/', function () {
    return view('welcome');
});