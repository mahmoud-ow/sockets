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

anna.treutel@example.org
littel.adah@example.net
tromp.annie@example.com

*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');




/* chat  */
Route::get('/contacts', 'ContactsController@get');
Route::get('/conversations/{id}', 'ContactsController@getMessagesFor');
Route::post('/conversations/send', 'ContactsController@send');