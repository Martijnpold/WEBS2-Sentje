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

Route::redirect('/', '/home');
Route::redirect('/post-login', '/paymentaccounts');

Route::get('/home', function () {
    return view('home');
});

Route::resource('/payments', 'PaymentRequestController')->except([
    'edit', 'update'
]);;

Route::post('/update_payment_status', ['uses' => 'PaymentController@update']);
Route::resource('/pay', 'PaymentController')->only([
    'show', 'store'
]);;

Route::resource('/paymentaccounts', 'PaymentAccountController')->except([
    'edit', 'update'
]);;

Route::resource('/createrequest', 'PaymentRequestController')->except([
    'edit', 'update'
]);;

Auth::routes();