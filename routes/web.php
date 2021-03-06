<?php

use Illuminate\Support\Facades\Route;

use App\User;



Route::get('/round', function () {

    $number = round(-2.99487500, 8);

    return  $number;
});


Route::get('test', function () {
    
    $accounts = DB::table('users')->select('*');
    $accounts = $accounts->where('account_type', 'buyer');
    $accounts = $accounts->get();
    return $accounts;

});



Route::get('/map', function () {
    return view('home');
});


Route::get('/lang/{lang}', 'LanguageController@setLanguage');
Route::group(['middleware' => 'Lang' ], function(){


    Route::post('/locations', 'LocationController@addLocation');
    Route::delete('/locations/{markerId}', 'LocationController@deleteAccountLocation');

    

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


    // admin dashboard get all users
    Route::get('/users', 'UserController@usersView');
    Route::get('/fetch-users', 'UserController@usersData');

    Route::put('/users/{id}/state', 'UserController@changeState'); // admin only
    Route::post('/users/{id}/account_type', 'UserController@changeAccountType'); // admin only
    Route::delete('/users/{id}', 'UserController@delete'); // admin only

    // auth
    Route::namespace('Auth')->prefix('users')->group(function () {
     

        
        
        // user register
        Route::get('/register', 'RegisterController@show');
        Route::post('/register', 'RegisterController@store')->name('account.register');
        
        // user email
        Route::get('/register/email/verification/{email}', 'RegisterController@showVerification');
        Route::get('/register/email/verification/{email}/resend', 'RegisterController@resendVerification');
        Route::post('/register/email/verification', 'RegisterController@activateAccount')->name('account.email_verification');

        // user login
        Route::get('/login', 'LoginController@show')->name('login');
        Route::post('/login', 'LoginController@store')->name('account.login');

        // user forget password
        Route::get('/login/forget-password', 'LoginController@forgetPasswordView');
        Route::post('/login/forget-password', 'LoginController@forgetPasswordSendVerification')->name('account.reset_password');

        // user reset password
        //Route::get('/login/forget-password/verify/{email}/resend', 'LoginController@forgetPasswordResendVerification');
        Route::get('/login/reset-password/{email}/{key}', 'LoginController@forgetPasswordVerifyView');
        Route::post('/login/forget-password/update', 'LoginController@forgetPasswordReset')->name('password.update');
        
        // user logout
        Route::post('/logout', 'LoginController@logout');
    });


    /* USER ACTIONS */
    // change profile picture
    Route::post('/users/profile-picture', 'UserController@changeProfilePicture');
    Route::post('/users/update-settings', 'UserController@updateSettings');
    






});/* /lang() */