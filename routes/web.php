<?php

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
//     return view('welcome');
// });

//LOGIN
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

//REGISTER
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

//RESET PASSWORD
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

//INICIO
Route::get('/', 'HomeController@index')->name('home');
Route::get('detail/{slug}','HomeController@getDetail')->name('show.detail');
Route::get('/offer-items/{offer_id}', 'HomeController@getOfferPosters')->where('offer_id','[0-9]+');
Route::get('/offers','HomeController@getOffersPage')->name('offers');
Route::get('/guest-offers','HomeController@guestOffersPage')->name('offers.guest');

//IMPORTACIONES - EXPORTACIONES
Route::post('create-offer', 'HomeController@createOfferHeader')->name('offers.create.header');
Route::post('import-excel', 'HomeController@importExcel')->name('offers.import');
Route::post('import-image', 'HomeController@importImage')->name('images.import');
Route::get('stream-pdf/{offer_id}','HomeController@streamPdf')->name('stream.poster');
Route::get('download-pdf/{offer_id}','HomeController@downloadPdf')->name('download.poster');
 
//ELIMINAR U OBTENER IMAGENES, DISEÑO SELECCIONADO
Route::get('/get-image/{filename}', 'HomeController@getImage')->name('get.image');
Route::get('/delete-image/{id}', 'HomeController@destroyImage')->name('delete.image');
Route::post('/selected','HomeController@activeDesign')->name('selected.design');

//ELIMINAR y ACTUALIXZAR OFERTAS VUE
Route::delete('/delete-offer/{id}','HomeController@destroyOffer');
Route::resource('/offerPoster','OfferPosterController')->only('update','store');
Route::get('/delete-header/{id}', 'HomeController@destroyAll')->name('destroy.header');
Route::post('/downloaded', 'HomeController@downloaded');