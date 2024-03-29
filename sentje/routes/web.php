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

Route::get('startrequest/{paymentId}', 'PaymentRequestController@create')->name('create payment');

Route::resource('/payments', 'PaymentRequestController')->except([
    'edit', 'update'
])->middleware('auth');;;

Route::name('pay.update')->post('/update_payment_status', 'PaymentController@update');
Route::post('/update_payment_status', ['uses' => 'PaymentController@update']);
Route::resource('/pay', 'PaymentController')->only([
    'show', 'store'
]);;

Route::resource('/paymentaccounts', 'PaymentAccountController')->except([
    'edit', 'update'
])->middleware('auth');;;

Auth::routes();