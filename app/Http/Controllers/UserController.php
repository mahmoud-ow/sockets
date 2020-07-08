<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Social;

class UserController extends Controller
{

    public function usersView(Request $request){
        return view('/dashboards.admin.users');
    }


    public function usersData(Request $request){
        $users = User::where('email', '<>', 'admin@admin.com')->get();

        // add an unread key to each contact with the count of unread messages
        $users = $users->map(function($contact) {
            // set images
            $contact->profile_image =  ( $contact->getMedia('avatar')->first() ) ? $contact->getMedia('avatar')->first()->getUrl('thumb') : 'images/dashboard/profile-default-image.png' ;
            return $contact;
        });

        return \Response::json( ['data' => $users] );
                /* if($request->source){
        } */
    }

    public function changeState(Request $request){
        $update_state = User::where('id', $request->id)->update([ 'banned' => $request->new_state ]);
        if(!$update_state){
            return response()->json([ 'error' => 1, 'message' => trans('dashboard.something_wrong') ]);
        }
        return response()->json([ 'error' => 0, 'message' => trans('dashboard.updated_successfully') ]);
    }/* /changeState() */

    public function changeAccountType(Request $request){

        $id = $request->account_id;
        $email = $request->account_email;
        $account_type = $request->account_type;

        $update_account_type = User::where('id', $id)->where( 'email', $email )->update([ 'account_type' => $account_type ]);
        if(!$update_account_type){
            return response()->json([ 'error' => 1, 'message' => trans('dashboard.something_wrong') ]);
        }


        if(  $account_type == 'admin' ){
            $notification = __('dashboard.update_account_type_admin');
        } elseif(  $account_type == 'buyer' ){
            $notification = __('dashboard.update_account_type_buyer');
        } elseif( $account_type == 'seller' ){
            $notification = __('dashboard.update_account_type_seller');
        } elseif( $account_type == 'store' ){
            $notification = __('dashboard.update_account_type_store');
        } elseif( $account_type == 'driver' ){
            $notification = __('dashboard.update_account_type_driver');
        }

        $notification_token = \Str::random(20);
        $data=[];
        $data[] = array(
            'user_id'      => $id, 
            'content'      => $notification, 
            'language'     => auth()->user()->language,
            'notification_token' => $notification_token,
            "created_at"   => date('Y-m-d H:i:s'), # new \Datetime()
            "updated_at"   => date('Y-m-d H:i:s'), # new \Datetime()
        );


        $create_notification = \App\Notification::insert($data);




        return response()->json([ 'error' => 0, 'message' => trans('dashboard.updated_successfully') ]);

    }/* /changeAccountType() */

    public function delete(Request $request){
        $deleteUser = User::where('id',$request->id)->delete();
        if(!$deleteUser){
            return response()->json([ 'error' => 1, 'message' => trans('dashboard.something_wrong') ]);
        }
        return response()->json([ 'error' => 0, 'message' => trans('dashboard.deleted_successfully') ]);
    }/* /delete() */
















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
            'user_id' => auth()->id(),
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
