<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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

Route::get('/artisan-commands', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    //Artisan::call('config:cache');
    echo public_path().'<br>';
    echo env('APP_URL').'<BR>';
});

Route::get('/', [HomeController::class, 'index']);
Route::get('/contact', [HomeController::class, 'contact']);
Route::get('/about', [HomeController::class, 'about']);
Route::get('/news', [HomeController::class, 'news']);
Route::get('/news/getnews/{id}', [HomeController::class, 'getnews']);
Route::get('/publications', [HomeController::class, 'publications']);
Route::get('/pressclippings', [HomeController::class, 'pressclippings']);
Route::get('/download', [HomeController::class, 'download']);
Route::get('/viewall', [HomeController::class, 'viewall']);
Route::get('/services/{page}', [HomeController::class, 'services']);
Route::post('/searchresults', [HomeController::class, 'searchresults'])->name('searchresults');
Route::get('/procurements/{id}', [HomeController::class, 'procurements']);
Route::get('/procurementdetails/{procurement_id}', [HomeController::class, 'procurementdetails']);
Route::get('/procurementdetails/apply/{procurement_id}', [HomeController::class, 'applyforprocurement']);
Route::post('/apply/storecontractor', [HomeController::class, 'storecontractor'])->name('home.storecontractor');

Route::post('/verifyqrcode', [HomeController::class, 'verifyqrcode'])->name('filament.verifyqrcode');
// my code
Route::get('/register', [RegisterController::class, 'viewsignup']);
Route::post('/signup', [RegisterController::class, 'store'])->name('signup.store');
Route::post('/submitmessage', [HomeController::class, 'submitmessage'])->name('contact.submitmessage');
