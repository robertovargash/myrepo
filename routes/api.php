<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Contact;
use App\Http\Resources\Contact as ContactResource;
use App\Http\Resources\ContactCollection;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/contact-list', function () {
    return new ContactCollection(Contact::all());
});

Route::get('/contactt/{id}', function ($id) {
    return new ContactResource(Contact::findorFail($id));
});
