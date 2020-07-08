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
            // buyer
            return self::buyerDashboard();
        } elseif ( auth()->user()->account_type == 'seller' ){
            return 'seller';
        } elseif ( auth()->user()->account_type == 'shop'  ){
            return 'shop';
        } else if( auth()->user()->account_type == 'driver' ){
            return 'river';
        }

    }/* /assignDashboard() */





    public static function adminDashboard(){
        $locations = \App\Location::where('user_id', auth()->id())->get();
        return view('dashboards.admin.settings', compact('locations'));
    }/* /adminDashboard() */
    
    
    public static function buyerDashboard(){
        $social = self::getAccountSocial();
        $locations = \App\Location::where('user_id', auth()->id())->get();
        return view('dashboards.buyer.settings', compact('locations', 'social'));
    }/* /adminDashboard() */

    







    public static function userDashboard(){
        return redirect('/');
        $currencies = \App\Currency::all();
        $credits = \App\Credit::all();
        return view('dashboards.user.dashboard', compact('currencies','credits'));
    }/* /adminDashboard() */


 
    public static function getAccountSocial(){
        $social = Social::firstOrCreate([
            'user_id' => auth()->id(),
        ], [
        ]);
        return $social;
    }

}/* /CLASS */
