<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Social;

class UserController extends Controller
{

    public function changeProfilePicture(Request $request){
        if(!$request->file('image')){return response()->json([ 'error' => 1, 'message' => __('dashboard.please_choose_image')  ]);}

        auth()->user()->addMediaFromRequest('image')->toMediaCollection('avatar');
        
        return response()->json([
            'error'   => 0,
            'message' => __('dashboard.updated_successfully'),
            'thumb'   => auth()->user()->getMedia('avatar')->first()->getUrl('thumb'),
            'card'    => auth()->user()->getMedia('avatar')->first()->getUrl('card'),
        ]);
    }/* /changeProfilePicture() */





    public function updateSettings(Request $request){
        
        // social
        $fb_url      =  $request->fb_url;
        $twt_url     =  $request->twt_url;
        $gplus_url   =  $request->gplus_url;
        $rss_url     =  $request->rss_url;
        $db_url      =  $request->db_url;
        $be_url      =  $request->be_url;
        $de_url      =  $request->de_url;

        // acount info
        $acc_name    =  $request->acc_name;
        $website_url =  $request->website_url;
        $country     =  $request->country;
        
        // account password
        $new_pwd     =  $request->new_pwd;
        $new_pwd2    =  $request->new_pwd2;


        Social::updateOrCreate([
            'id' => '1'
        ], [
            'fb_url' => $fb_url,
            'twt_url' => $twt_url,
            'gplus_url' => $gplus_url,
            'rss_url' => $rss_url,
            'db_url' => $db_url,
            'be_url' => $be_url,
            'de_url' => $de_url,
            
        ]);
        

        if( !$acc_name ){
            return response()->json([
                'error' => 1,
                'message' => __('dashboard.account_name_required'),
            ]);
        }

        User::find(auth()->id())->update([
            'username' => $acc_name,
            'website' => $website_url,
            'country' => $country,
        ]);
        

        if( $new_pwd ){
            
            if(!$new_pwd2){
                return response()->json([
                    'error' => 1,
                    'message' => __('dashboard.password_confirmation_required'),
                ]);
            }

            if($new_pwd != $new_pwd2){
                return response()->json([
                    'error' => 1,
                    'message' =>  __('dashboard.password_match_error'),
                ]);
            }

            $updatePassword =  User::find(auth()->id())->update(['password' => Hash::make($new_pwd)]);
            
        }



        return response()->json([
            'error' => 0,
            'message' => __('dashboard.updated_successfully'),
        ]);

    }/* /updateSettings() */

}/* /CLASS */
