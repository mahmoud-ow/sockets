<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


use App\Notification;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerification;
use Illuminate\Http\Request;



class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
  

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    





    public function show(){
        return view('auth.register');
    }


    protected function store(Request $request){
        
        $request->validate([
            'email'          => 'required|email|unique:users',
            'username'       =>  'required',
            'password'       => 'required|confirmed|min:6',
            'account_type'   =>  'required',
        ]);

        $account_types = ['buyer', 'seller', 'shop', 'driver'];
  
        $verification_key = \Str::random(10);
        
        if(in_array($request->account_type, $account_types)){
            $data = array(
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'account_type' => $request->account_type,
                'verification_key' => $verification_key,
            );
    
            $user =  User::create($data);
    
            if( $user ){
    
                Mail::to($request->email)->send( new EmailVerification($data));
    
                return redirect('/users/register/email/verification/'.$request->email);
    
            } else {
                return redirect()->back()->withErrors(['error' => trans('validation.custom.feedback.something-wrong')]);
            }
        } else {
            return redirect()->back()->withErrors(['error' => trans('validation.custom.feedback.something-wrong')]);
        }
        
        

    }



    public function showVerification(Request $request){
        
        if($request->email){
            $email = $request->email;
            return view('auth.verify', compact('email'));
        } else {
            return redirect('/users/login');
        }
        

    }/* /showVerification() */



    public function resendVerification(Request $request){

        $user = User::where('email', $request->email)->first();

        if($user){
            
            $verification_key = \Str::random(10);

            $user->verification_key = $verification_key;
            $user->save();

            $data = array(
                'username' => $user->username,
                'email' => $user->email,
                'verification_key' => $verification_key,
            );

            Mail::to($request->email)->send( new EmailVerification($data));

            return redirect('/users/register/email/verification/'.$request->email);

        } else {
            return redirect('/users/register');
        }

        

    }/* /resendVerification() */



    public function activateAccount(Request $request){

    


        $validator = Validator::make($request->all(), [
            'email'     => 'required|email',
            'verification_key'  => 'required',
        ],
        [
            'verification_key.required' => __('auth.enter_verification_code'),
        ]);
    
        if ($validator->fails()) {
            return redirect('/users/register/email/verification/'.$request->email)
                        ->withErrors($validator)
                        ->withInput();
        }
        
        
        $user = User::where('email', $request->email)->where('verification_key', $request->verification_key)->first();

        if($user){
            
            $user->verification_key = null;
            $user->email_verified_at = \Carbon\Carbon::now();
            $user->save();

            return redirect('/users/login')->with('verification_success', trans('auth.email_verification_success'));
            
        } else {
            return redirect('/users/register/email/verification/'.$request->email)->withErrors(['wrong_info' => __('auth.verification_wrong_info')]);
        }
        

    }/* /activateAccount() */





}/* /CLASS */
