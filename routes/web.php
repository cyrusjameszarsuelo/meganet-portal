<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\CorporateOfficeController;
use App\Http\Controllers\MegatriviaController;
use App\Http\Controllers\MegaprojectController;
use App\Http\Controllers\MeganewsController;
use App\Http\Controllers\MegagoodVibesController;
use App\Http\Controllers\NominationController;
use App\Http\Controllers\MetricController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OurCompanyController;
use App\Http\Controllers\OurBusinessesAndSubsidiariesController;
use Dcblogdev\MsGraph\Models\MsGraphToken;

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

// Route::get('/', function () {
//     return view('pages.main');
// });

// Login

Route::redirect('/', 'login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['web', 'guest'], 'namespace' => 'App\Http\Controllers'], function(){
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::get('connect', [AuthController::class, 'connect'])->name('connect');
});

Route::group(['middleware' => ['web', 'MsGraphAuthenticated']], function(){


    // Main Controller

    Route::get('/home', [MainController::class, 'index']);
    Route::get('/our-company', [OurCompanyController::class, 'index']);
    Route::get('/our-company/details', [MainController::class, 'ourCompanyDetails']);
    Route::get('/our-business-and-subsidiaries', [OurBusinessesAndSubsidiariesController::class, 'index']);
    Route::get('/megawide-construction', [MainController::class, 'megawideConstruction']);
    Route::get('/pcs', [MainController::class, 'pcs']);
    Route::get('/pcs/{file}/', [MainController::class, 'storePcsFiles']);
    Route::get('/megawide-construction/{file}', [MainController::class, 'storeMegawideConstructionFiles']);

    Route::post('/pcsUpload/{file}', [MainController::class, 'pcsUpload']);
    Route::post('/megawideConstructionUpload/{file}', [MainController::class, 'megawideConstructionUpload']);


    Route::get('/getLikesOnComment', [MainController::class, 'getLikesOnComment']);

    Route::post('/submitBannerComment', [MainController::class, 'submitBannerComment'])->name('submitBannerComment');
    Route::post('/updateBannerComment', [MainController::class, 'updateBannerComment'])->name('updateBannerComment');
    Route::post('/deleteCommentBanner', [MainController::class, 'destroy']);
    Route::post('/likeBannerComment', [MainController::class, 'likeBannerComment']);
    Route::post('/removeLikeBannerComment', [MainController::class, 'removeLikeBannerComment']);


    // Metrics Controller

    Route::post('/storeMetrics', [MetricController::class, 'store']);


    // Corporate Office Controller

    Route::get('/corporate-office/{id}', [CorporateOfficeController::class, 'index']);
    Route::get('/corporate-office/{file}/{id}', [CorporateOfficeController::class, 'create']);

    Route::post('/uploadFile/{file}/{id}', [CorporateOfficeController::class, 'upload']);



    // MegagoodVibes Controller 

    Route::get('/megagood-vibes/{id?}', [MegagoodVibesController::class, 'index']);

    Route::post('/submitCommentMegagoodVibes', [MegagoodVibesController::class, 'store'])->name('submitCommentMegagoodVibes');
    Route::post('/likeMegagoodVibesContent', [MegagoodVibesController::class, 'likeMegagoodVibesContent'])->name('likeMegagoodVibesContent');
    Route::post('/updateMegagoodVibesComment', [MegagoodVibesController::class, 'updateMegagoodVibesComment'])->name('updateMegagoodVibesComment');
    Route::post('/deleteCommentMegagoodVibes', [MegagoodVibesController::class, 'destroy']);


    // Meganews Controller 

    Route::get('/meganews/{date?}', [MeganewsController::class, 'index']);
    Route::get('/meganews/details/{id}', [MeganewsController::class, 'view']);

    Route::post('/submitCommentMeganews', [MeganewsController::class, 'store'])->name('submitCommentMeganews');
    Route::post('/updateMeganewsComment', [MeganewsController::class, 'update'])->name('updateMeganewsComment');
    Route::post('/deleteCommentMeganews', [MeganewsController::class, 'destroy']);
    Route::post('/likeMeganewsContent', [MeganewsController::class, 'likeMeganewsContent']);


    // Megaproject Controller 

    Route::get('/megaprojects/{id?}', [MegaprojectController::class, 'index']);
    Route::get('/megaprojects/megaproject-details/{id?}', [MegaprojectController::class, 'megaprojectDetail']);

    // Megatrivia Controller

    Route::get('/megatrivia', [MegatriviaController::class, 'index']);
    Route::get('/megatrivia/all-megatrivia', [MegatriviaController::class, 'allMegatrivia']);

    Route::post('/submitAnswerMegatrivia', [MegatriviaController::class, 'store'])->name('submitAnswerMegatrivia');

    Route::get('/nomination-mechanics', [NominationController::class, 'mechanics']);
    Route::get('/nomination', [NominationController::class, 'index']);
    Route::get('/nomination-group', [NominationController::class, 'group']);
    Route::get('/getBehavior', [NominationController::class, 'getBehavior']);

    Route::post('/nominate', [NominationController::class, 'store']);

    Route::get('/getValidEmployees', [NominationController::class, 'getValidEmployees']);
    Route::get('/getUsersTest', [NominationController::class, 'getUsersTest']);

    
});