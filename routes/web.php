<?php

use Illuminate\Support\Facades\Route;

use App\User;


Route::get('test', function () {
    
    $accounts = DB::table('users')->select('*');
    $accounts = $accounts->where('account_type', 'buyer');
    $accounts = $accounts->get();
    return $accounts;

});



Route::get('/lang/{lang}', 'LanguageController@setLanguage');
Route::group(['middleware' => 'Lang' ], function(){


    

    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/home', 'HomeController@index')->name('home');


    


    // dashboard
    Route::get('/dashboard', 'DashBoardController@assignDashboard');// admin or user


    
    
    Route::prefix('notifications')->group(function () {
        
        Route::get('/', 'NotificationController@assignNotification');
        
        Route::get('/all', 'NotificationController@fetch');

        Route::post('/', 'NotificationController@addNotification');
        Route::get('/{notification_token}', 'NotificationController@edit');
        Route::put('/{notification_token}', 'NotificationController@update');
        Route::delete('/{notification_token}', 'NotificationController@delete');

    });

















    

    /* chat  */
    Route::get('/contacts', 'ContactsController@get');
    Route::get('/conversations/{id}', 'ContactsController@getMessagesFor');
    Route::post('/conversations/send', 'ContactsController@send');


    

    // auth
    Route::namespace('Auth')->prefix('users')->group(function () {
     
        
        Route::get('/register', 'RegisterController@show');
        Route::post('/register', 'RegisterController@store')->name('account.register');
        
        
        Route::get('/register/email/verification/{email}', 'RegisterController@showVerification');
        Route::get('/register/email/verification/{email}/resend', 'RegisterController@resendVerification');
        Route::post('/register/email/verification', 'RegisterController@activateAccount')->name('account.email_verification');

        Route::get('/login', 'LoginController@show')->name('login');
        Route::post('/login', 'LoginController@store')->name('account.login');

        Route::get('/login/forget-password', 'LoginController@forgetPasswordView');
        Route::post('/login/forget-password', 'LoginController@forgetPasswordSendVerification')->name('account.reset_password');

        //Route::get('/login/forget-password/verify/{email}/resend', 'LoginController@forgetPasswordResendVerification');
        Route::get('/login/reset-password/{email}/{key}', 'LoginController@forgetPasswordVerifyView');
        Route::post('/login/forget-password/update', 'LoginController@forgetPasswordReset')->name('password.update');
        
        Route::post('/logout', 'LoginController@logout');
    });


    /* USER ACTIONS */
    // change profile picture
    Route::post('/users/profile-picture', 'UserController@changeProfilePicture');
    Route::post('/users/update-settings', 'UserController@updateSettings');
    






});/* /lang() */