<?php

use App\Http\Controllers\TicketController;
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
Route::get('/storage-link', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
});

Route::get('/', 'App\Http\Controllers\TicketController@index')->middleware(['auth']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function(){
    Route::resource('ticket', TicketController::class);

    Route::get('ticket/{ticket}/payment', 'App\Http\Controllers\TicketController@addPaymentView')->middleware('can:edit-tickets')->name('ticket.add_payment');
    Route::post('ticket/{ticket}/payment', 'App\Http\Controllers\TicketController@addPayment')->middleware('can:edit-tickets')->name('ticket.add_payment_post');

    // user
    Route::get('create/user', 'App\Http\Controllers\UserController@create')->middleware('can:create,App\Models\User')->name('user.create');

    Route::post('store/user', 'App\Http\Controllers\UserController@store')->middleware('can:store,App\Models\User')->name('user.store');

    Route::get('index/user', 'App\Http\Controllers\UserController@index')->middleware('can:view,App\Models\User')->name('user.index');

    Route::get('edit/user/{id}', 'App\Http\Controllers\UserController@edit')->middleware('can:edit,App\Models\User')->name('user.edit');

    Route::post('update/user/{id}', 'App\Http\Controllers\UserController@update')->middleware('can:update,App\Models\User')->name('user.update');

    Route::get('reset/user/password/{id}', 'App\Http\Controllers\UserController@resetPassword')->middleware('can:resetPasswordGet,App\Models\User')->name('user-reset-password');

    Route::post('reset/password/{id}', 'App\Http\Controllers\UserController@reset')->middleware('can:resetPassword,App\Models\User')->name('password-reset');



    //change password
    Route::get('change/password', 'App\Http\Controllers\ChangePasswordController@changePassword')->name('change-password');

    Route::post('update/password', 'App\Http\Controllers\ChangePasswordController@updatePassword')->name('update-password');

    //ticket_payment_edit
    Route::get('ticket_payment/{id}', 'App\Http\Controllers\TicketPaymentController@editTicketPayment')->middleware('can:editTicketPayment,App\Models\Ticket')->name('ticket_payment.edit');
    Route::post('ticket_payment_update/{id}', 'App\Http\Controllers\TicketPaymentController@updateTicketPayment')->middleware('can:updateTicketPayment,App\Models\Ticket')->name('ticket_payment.update');

    //activity_log

    Route::get('/add-to-log', 'App\Http\Controllers\TicketPaymentActivityController@indexTicketActivity')->middleware('can:edit-tickets')->name('ticket_activity_log');


});

require __DIR__.'/auth.php';

