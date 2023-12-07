<?php

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

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [App\Http\Controllers\Props\PropertiesController::class, 'index'])->name('home');


Auth::routes();

Route::group(['prefix' => 'home'], function(){
Route::get('/', [App\Http\Controllers\Props\PropertiesController::class, 'index'])->name('home');

//order by price
Route::get('/priceAsc', [App\Http\Controllers\Props\PropertiesController::class, 'orderByPriceAsc'])->name('home.orderByPriceAsc');
Route::get('/priceDesc', [App\Http\Controllers\Props\PropertiesController::class, 'orderByPriceDesc'])->name('home.orderByPriceDesc');

//display contacts and about pages
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact.page');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about.page');
});


Route::group(['prefix' => 'props'], function(){

Route::get('/props-details/{id}', [App\Http\Controllers\Props\PropertiesController::class, 'single'])->name('single.prop');

//insert requests
Route::post('/props-details/{id}', [App\Http\Controllers\Props\PropertiesController::class, 'insertRequest'])->name('insert.request');

//saved properties
Route::post('/save-props/{id}', [App\Http\Controllers\Props\PropertiesController::class, 'saveProps'])->name('save.props');

//displaying property by available type
Route::get('/type/Buy', [App\Http\Controllers\Props\PropertiesController::class, 'propsToBuy'])->name('props.buy');
Route::get('/type/Rent', [App\Http\Controllers\Props\PropertiesController::class, 'propsToRent'])->name('props.rent');


//display home types
Route::get('/home-type/{homeType}', [App\Http\Controllers\Props\PropertiesController::class, 'displayHomeType'])->name('home.types');

//order by price
Route::get('/home}', [App\Http\Controllers\Props\PropertiesController::class, 'orderByPrice'])->name('home.orderByPrice');

//searching properties
Route::any('/search', [App\Http\Controllers\Props\PropertiesController::class, 'searchProps'])->name('search.props');
});

Route::group(['prefix' => 'users'], function(){
//user pages
Route::get('/all-requests', [App\Http\Controllers\Users\UsersController::class, 'allRequests'])->name('users.all.requests');
Route::get('/saved-properties', [App\Http\Controllers\Users\UsersController::class, 'savedProperties'])->name('users.saved.properties');
});

Route::get('/admin/login', [App\Http\Controllers\Admins\AdminsController::class, 'viewLogin'])->name('admin.view.login')->middleware('checkforauth');
Route::post('/admin/check-login', [App\Http\Controllers\Admins\AdminsController::class, 'checkLogin'])->name('admin.check.login');


Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function(){

   
    Route::get('/dashboard', [App\Http\Controllers\Admins\AdminsController::class, 'index'])->name('admins.dashboard');

    //admins panel
    Route::get('/all-admins', [App\Http\Controllers\Admins\AdminsController::class, 'allAdmins'])->name('admins.all');
    Route::get('/add-admin', [App\Http\Controllers\Admins\AdminsController::class, 'addAdmin'])->name('admins.add');
    Route::post('/add-admin', [App\Http\Controllers\Admins\AdminsController::class, 'storeAdmin'])->name('admins.store');

    //home type panel
    Route::get('/all-home-types', [App\Http\Controllers\Admins\AdminsController::class, 'allHomeTypes'])->name('admins.allhometypes');
    Route::get('/add-home-types', [App\Http\Controllers\Admins\AdminsController::class, 'addHomeTypes'])->name('admins.addHomeTypes');
    Route::post('/add-home-types', [App\Http\Controllers\Admins\AdminsController::class, 'storeHomeTypes'])->name('admins.storeHomeTypes');
    Route::get('/update-home-types/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'editHomeTypes'])->name('admins.editHomeTypes');
    Route::post('/update-home-types/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'updateHomeTypes'])->name('admins.updateHomeTypes');
    Route::any('/delete-home-types/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'deleteHomeTypes'])->name('admins.deleteHomeTypes');
});