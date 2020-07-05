<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Social;
class DashBoardController extends Controller
{
    

    public function __construct(){
        parent::__construct();
        $this->middleware('auth');
    }



    public function assignDashboard(){
        

        if( auth()->user()->account_type == 'admin' ){ 
            // admin
            return self::adminDashboard();

        } elseif( auth()->user()->account_type == 'buyer' ) { 
            // user
            return 'buyer';
            return self::userDashboard();
        } elseif ( auth()->user()->account_type == 'seller' ){
            return 'seller';
        } elseif ( auth()->user()->account_type == 'shop'  ){
            return 'shop';
        } else if( auth()->user()->account_type == 'driver' ){
            return 'river';
        }

    }/* /assignDashboard() */





    public static function adminDashboard(){
        return view('dashboards.admin.settings');
    }/* /adminDashboard() */

    







    public static function userDashboard(){
        return redirect('/');
        $currencies = \App\Currency::all();
        $credits = \App\Credit::all();
        return view('dashboards.user.dashboard', compact('currencies','credits'));
    }/* /adminDashboard() */


 


}/* /CLASS */
