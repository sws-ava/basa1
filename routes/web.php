<?php

use App\Http\Controllers\Admin\BadgeController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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



Route::get('/blr', function () {

    $arr =  DB::table('blr')->get();

    // foreach ($arr as $row) {
    //     // dd($row);
    //     $row1 = explode('==', $row->dirty);
    //     $row2 = explode('//', $row1[1]);
    //     $row3 = explode(',', $row2[1]);

    //     $city_name = $row2[0] . ' ' . '(UA)';
    //     $city_dist_name = $row3[0] . ' ' . '(UA)';

    //     // dd($row->id);

    //     $affected = DB::table('blr')
    //         ->where('id', $row->id)
    //         ->update([
    //             'name' => $city_name,
    //             'dirty_reg' => $city_dist_name,
    //         ]);
    // }


    $dist_regs = DB::table('blr')->select('dirty_reg')->distinct()->get();


    // dd($dist_regs);

    // foreach ($dist_regs as $dist_reg) {
    //     echo $dist_reg->dirty_reg . '<br>';
    // }

    // $arr =  DB::table('blr')->get();

    // foreach ($arr as $row) {
    //     // dd($row->dirty_reg);

    //     if ($row->dirty_reg == 'Донецкая область (UA)') {
    //         $reg_id = 94;
    //     } elseif ($row->dirty_reg == 'Кировоградская область (UA)') {
    //         $reg_id = 95;
    //     } elseif ($row->dirty_reg == 'Луганская область (UA)') {
    //         $reg_id = 96;
    //     } elseif ($row->dirty_reg == 'Житомирская область (UA)') {
    //         $reg_id = 97;
    //     } elseif ($row->dirty_reg == 'Днепропетровская область (UA)') {
    //         $reg_id = 98;
    //     } elseif ($row->dirty_reg == 'Николаевская область (UA)') {
    //         $reg_id = 99;
    //     } elseif ($row->dirty_reg == 'Одесская область (UA)') {
    //         $reg_id = 100;
    //     } elseif ($row->dirty_reg == 'Сумская область (UA)') {
    //         $reg_id = 101;
    //     } elseif ($row->dirty_reg == 'Харьковская область (UA)') {
    //         $reg_id = 102;
    //     } elseif ($row->dirty_reg == 'Киевская область (UA)') {
    //         $reg_id = 103;
    //     } elseif ($row->dirty_reg == 'Черниговская область (UA)') {
    //         $reg_id = 104;
    //     } elseif ($row->dirty_reg == 'Закарпатская область (UA)') {
    //         $reg_id = 105;
    //     } elseif ($row->dirty_reg == 'Тернопольская область (UA)') {
    //         $reg_id = 106;
    //     } elseif ($row->dirty_reg == 'Ровенская область (UA)') {
    //         $reg_id = 107;
    //     } elseif ($row->dirty_reg == 'Волынская область (UA)') {
    //         $reg_id = 108;
    //     } elseif ($row->dirty_reg == 'Херсонская область (UA)') {
    //         $reg_id = 109;
    //     } elseif ($row->dirty_reg == 'Ивано-Франковская область (UA)') {
    //         $reg_id = 110;
    //     } elseif ($row->dirty_reg == 'Львовская область (UA)') {
    //         $reg_id = 111;
    //     } elseif ($row->dirty_reg == 'Черкасская область (UA)') {
    //         $reg_id = 112;
    //     } elseif ($row->dirty_reg == 'Полтавская область (UA)') {
    //         $reg_id = 113;
    //     } elseif ($row->dirty_reg == 'Запорожская область (UA)') {
    //         $reg_id = 114;
    //     } elseif ($row->dirty_reg == 'Черновицкая область (UA)') {
    //         $reg_id = 115;
    //     } elseif ($row->dirty_reg == 'Винницкая область (UA)') {
    //         $reg_id = 116;
    //     } elseif ($row->dirty_reg == 'Хмельницкая область (UA)') {
    //         $reg_id = 117;
    //     }



    //     $affected = DB::table('blr')
    //         ->where('id', $row->id)
    //         ->update([
    //             'reg_id' => $reg_id,
    //         ]);
    // }


    foreach ($arr as $row) {


        $affected = DB::table('geo_city')->insert([
            'region_id' => $row->reg_id,
            'name' => $row->name,
        ]);
    }

    return 'welcome';
});




Auth::routes();

Route::get('/', [App\Http\Controllers\CatalogController::class, 'index']);
Route::get('/register', [App\Http\Controllers\CatalogController::class, 'redirectToLogin']);
Route::get('/company/{id}', [App\Http\Controllers\CatalogController::class, 'showCompany']);
Route::get('/company', [App\Http\Controllers\CatalogController::class, 'redirect']);





Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/badges', [App\Http\Controllers\BadgeController::class, 'index'])->name('badges');
Route::get('/about', [App\Http\Controllers\AboutController::class, 'index'])->name('about');


Route::middleware(['role:admin|user'])->prefix('administrator')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index']);
});

Route::middleware(['role:admin'])->prefix('administrator')->group(function () {
    Route::resource('badge', App\Http\Controllers\Admin\BadgeController::class);
    Route::get('all_companies', [App\Http\Controllers\Admin\CompanyController::class, 'all'])->name('all_companies');
    Route::post('hide_company', [App\Http\Controllers\Admin\CompanyController::class, 'hide_company'])->name('hide_company');
    Route::resource('company', App\Http\Controllers\Admin\CompanyController::class);
    Route::resource('fieldWorks', App\Http\Controllers\Admin\FieldWorksController::class);
    Route::resource('head', App\Http\Controllers\Admin\HeadController::class);
    Route::resource('specWorks', App\Http\Controllers\Admin\SpecWorksController::class);
    Route::resource('researchSolutions', App\Http\Controllers\Admin\ResearchSolutionController::class);
    Route::resource('companyMore', App\Http\Controllers\Admin\CompanyMoreController::class);
    Route::resource('companyResources', App\Http\Controllers\Admin\CompanyResourceController::class);
    Route::resource('companyLogo', App\Http\Controllers\Admin\CompanyLogoController::class);
    Route::resource('companyBadges', App\Http\Controllers\Admin\CompanyBadgeController::class);
    Route::post('show', [App\Http\Controllers\Admin\CompanyShowController::class, 'show'])->name('show');
    Route::post('top', [App\Http\Controllers\Admin\CompanyTopController::class, 'top'])->name('top');
    Route::resource('companyBanner', App\Http\Controllers\Admin\CompanyBannerController::class);
    Route::resource('companyFile', App\Http\Controllers\Admin\CompanyFileController::class);
    Route::resource('companyPhoto', App\Http\Controllers\Admin\CompanyPhotoController::class);
    Route::resource('page', App\Http\Controllers\Admin\PageController::class);
});


Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});
