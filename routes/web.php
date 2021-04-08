<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;
use App\Http\Resources\Contact as ContactResource;

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

Route::get('/', function () {
    return redirect()->route('home');
})->middleware('translate');

Route::get('/', function () {
    $title = "ISUCorp Test";
    return redirect()->route('home');
});

Route::get('/lang/{language}', function ($language) {
    Session::put('language',$language);
    return redirect()->back();
})->name('language');



Route::resource('contacts','ContactController');
Route::delete('contact_delete_modal', 'ContactController@destroy')->name('contacts.destroy');

Route::resource('contacttypes','ContacttypeController');
Route::delete('contacttype_delete_modal', 'ContacttypeController@destroy')->name('contacttypes.destroy');

Route::post('users/{id}', function ($id) {

});

Route::put('users/{id}', function ($id) {

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
