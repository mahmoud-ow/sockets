<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Notification;
use App\User;
use App;

class NotificationController extends Controller
{
    

    public function assignNotification(){
        if( auth()->user()->account_type == 'admin' ){ 
            // admin
            return self::adminNotification();

        } elseif( auth()->user()->account_type == 'buyer' ) { 
            // user
            return 'buyer';
            return self::userNotification();
        } elseif ( auth()->user()->account_type == 'seller' ){
            return 'seller';
        } elseif ( auth()->user()->account_type == 'shop'  ){
            return 'shop';
        } else if( auth()->user()->account_type == 'driver' ){
            return 'river';
        }

    }/* /assignNotification() */



    public function adminNotification(){
        return view('dashboards.admin.notifications');
    }/* /adminNotification() */






    
    public function addNotification(Request $request){
     
      
        if($request->notification_accounts=='all' && $request->notification_language == 'all'){
            $accounts = User::all();
        } else {

            $accounts = User::latest();
            
            if($request->notification_accounts != 'all'){
                $accounts = $accounts->where('account_type', $request->notification_accounts);
            }
            if($request->notification_language != 'all'){
                $accounts = $accounts->where('language', $request->notification_language);
            }

            $accounts = $accounts->get();
        }


        if($accounts->count()>0){

            $notification_token = \Str::random(20);
            $data=[];

            foreach($accounts as $user){

                $data[] = array(
                    'user_id'      => $user->id , 
                    'audience'     => $request->notification_accounts,
                    'language'     => $request->notification_language,
                    'content'      => $request->notification_content,
                    'notification_token' => $notification_token,
                    'source'       => 'adminstration',
                    "created_at"   => date('Y-m-d H:i:s'), # new \Datetime()
                    "updated_at"   => date('Y-m-d H:i:s'), # new \Datetime()
                );
                
            }

            $create_notification = Notification::insert($data);
            if(!$create_notification){
                return response()->json([ 'error' => 1, 'message' => __('dashboard.something_wrong'), ]);    
            }
            return response()->json([ 'error' => 0, 'message' => __('dashboard.added_successfully'), ]);

        } else {
            return response()->json([ 'error' => 1, 'message' => __('dashboard.no_audience') ]);
        }
        
    }/* /addNotification() */





    public function fetch(Request $request){
        


        if(auth()->user()->account_type == 'admin'){
            
            // for admin datatable
            $all_notifications = Notification::where('source', 'adminstration')->get();
            $all_notifications = $all_notifications->groupBy('notification_token');
            
            $notifications_array=[];
            // constructing $notifications_array
            foreach($all_notifications as $notification){
                
             

                $audience = $notification[0]->audience;
                if ($audience == 'all') {
                    $audience = __('dashboard.all');
                } elseif ( $audience == 'buyer' ){
                    $audience = __('dashboard.buyers');
                } elseif ( $audience == 'seller' ){
                    $audience = __('dashboard.sellers');
                } elseif ( $audience == 'driver' ){
                    $audience = __('dashboard.drivers');
                } elseif ( $audience == 'shop' ){
                    $audience = __('dashboard.shops');
                }
        
                
                
                $language = $notification[0]->language;
                if($language == 'all'){
                    $language = __('dashboard.all');
                } else if($language == 'en'){
                    $language = __('dashboard.english');
                } else if($language == 'ar'){
                    $language = __('dashboard.arabic');
                }



                
                

                $notification_row;
                $notification_row['id']           = $notification[0]->id;
                $notification_row['notification_token'] = $notification[0]->notification_token;
                $notification_row['content']      = "<textarea disabled class='form-control' style='direction:rtl;width:100%;height: 48px;min-height: 48px;text-align:center;'> ". $notification[0]->content ." </textarea>";
                $notification_row['audience']     = $audience." / ".$language." &nbsp; <span class='myButton' style='border-bottom: 1px dashed;color:salmon;cursor:pointer;'>(".$notification->count().")</span>";
                $notification_row['count']        = $notification->count();
                $notification_row['views']        = $notification->where('seen', 1)->count();
                $notification_row['created_at']   = $notification[0]->created_at->calendar();
            
                $notifications_array[] = $notification_row;
            }
            return response()->json([ 'data' => $notifications_array ]);
            
        } elseif($request->account_type=='user') {

            // for user
            // this code will do the following
            // 1- load latest 20 notification for the user
            // 2- load more 20 notification if the user requested
            // 3- load new notifications ( interval ajax )
            




            $fetch_count = 100;

            if($request->previous_notifications=='true'){
                $notifications = Notification::where('user_id', auth()->user()->id)->where('id', '<', $request->bottom_notification)->latest()->skip(0)->take($fetch_count)->get();
            } else {
                $first_load       = $request->first_load; // true or false
                $top_notification = $request->top_notification; // 0 or > 0

                if($first_load != 'false'){
                    $notifications = Notification::where('user_id', auth()->user()->id)->latest()->skip(0)->take($fetch_count)->get();
                } else {
                    $notifications = Notification::where('id', '>', $top_notification)->where('user_id', auth()->user()->id)->latest()->get();
                    $notifications = $notifications->reverse();
                }
            }



     
            $notification_html_structure = '';

            if($notifications->count()>0){
                foreach($notifications as $notification){
                    
                    // set seen
                    if($notification->seen==1){
                        $seen_icon  = '<i class="far fa-bell"></i>';
                        $seen_class = '';
                    } else {
                        $seen_icon  = '<i class="fas fa-bell"></i>';
                        $seen_class = 'notSeen';
                    }

                    $notification_html_structure .= 
                    '<div data-id="'.$notification->id.'" class="header-notification-row '. $seen_class .'"><div class="notificationSeenIcon">'. $seen_icon .'</div><div><div class="notificationAndMessageloadingAnimation"><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></div><div>'. $notification->content .'</div></div></div>';
                    ;

                }
            }



            // check to see if there is unknown notifications for the user ( doesn't have to be seen ) = set new notifications counter
            $unseen_notifications_counter =  Notification::where('user_id', auth()->user()->id)->where('seen', 0)->count();
            
            return response()->json([ 'data' => $notification_html_structure, 'number_of_unseen_notifications' => $unseen_notifications_counter ]);

            
        }









    }/* /fetch() */


    

    public function edit(Request $request){

        $notification = Notification::where('notification_token', $request->notification_token)->first();
        if($notification){

            
            /* 
            <option value="all">'.__('dashboard.all').'</option>
            <option value="buyer"> '.__('dashboard.buyers').'</option>
            <option value="seller"> '.__('dashboard.sellers').'</option>
            <option value="store">'.__('dashboard.shops').'</option>
            <option value="driver">'.__('dashboard.drivers').'</option>
            */

            $account_types = [
                'all' => __('dashboard.all'),
                'buyer' => __('dashboard.buyers'),
                'seller' => __('dashboard.sellers'),
                'store' => __('dashboard.stores'),
                'driver' => __('dashboard.drivers'),
            ];
            
            $account_types_html = '';
            foreach($account_types as $key => $value){
                if( $notification->audience == $key ){
                    $account_types_html .= '<option selected value="'.$key.'"> '.$value.'</option>';
                } else {
                    $account_types_html .= '<option value="'.$key.'"> '.$value.'</option>';
                }
            }


            $account_languages = [
                'all' => __('dashboard.all'),
                'ar' => __('dashboard.arabic'),
                'en' => __('dashboard.english'),
            ];
            $account_languages_html = '';
            foreach($account_languages as $key => $value){
                if( $notification->language == $key ){
                    $account_languages_html .= '<option selected value="'.$key.'"> '.$value.'</option>';
                } else {
                    $account_languages_html .= '<option value="'.$key.'"> '.$value.'</option>';
                }
            }


            $edit_html = '
            <div id="edit_notification_modal">
                <textarea class="form-control" id="edit_notification_textarea" placeholder="'.__('dashboard.notification_here').'">'.$notification->content.'</textarea>
            
            
                <table>
                
                    <tr>
                    <td>
                        '.__('dashboard.accounts_types').'
                    </td>
                    <td>
                        <label for="edit_notification_accounts" class="select-block">
                        <select form="profile-info-form" name="edit_notification_accounts" id="edit_notification_accounts">
                            '.$account_types_html.'
                        </select>
                        
                        <svg class="svg-arrow">
                            <use xlink:href="#svg-arrow"></use>
                        </svg>
                    </label>
                    </td>
                    </tr>



                    <tr>
                    <td>
                        '.__('dashboard.accounts_languages').'
                    </td>
                    <td>
                        <label for="edit_notification_language" class="select-block">
                        <select form="profile-info-form" name="edit_notification_language" id="edit_notification_language">
                            '.$account_languages_html.'
                        </select>
                        
                        <svg class="svg-arrow">
                            <use xlink:href="#svg-arrow"></use>
                        </svg>
                        </label>
                    </td>
                    </tr>



                </table>
            </div>
            ';

            return response()->json([ 'error' => 0, 'token' => $notification->notification_token, 'edit_html' => $edit_html ]);
        } else {
            return response()->json([ 'error' => 1, 'message' => trans('dashboard.something_wrong'), ]);
        }
        
    }/* /edit() */


    public function update(Request $request){


        if($request->notification_accounts=='all' && $request->notification_language == 'all'){
            $accounts = User::all();
        } else {

            $accounts = User::latest();
            
            
            if($request->notification_accounts != 'all'){
                $accounts = $accounts->where('account_type', $request->notification_accounts);
            }

            if($request->notification_language != 'all'){
                $accounts = $accounts->where('language', $request->notification_language);
            }

            $accounts = $accounts->get();

        }


        if($accounts->count()>0){

            $notification_token = $request->notification_token;
            $data=[];

            foreach($accounts as $user){

                $data[] = array(
                    'user_id'      => $user->id , 
                    'audience'     => $request->notification_accounts,
                    'language'     => $request->notification_language,
                    'content'      => $request->notification_content,
                    'notification_token' => $notification_token,
                    'source'       => 'adminstration',
                    "created_at"   => date('Y-m-d H:i:s'), # new \Datetime()
                    "updated_at"   => date('Y-m-d H:i:s'), # new \Datetime()
                );
                
            }
            Notification::where('notification_token', $request->notification_token)->delete();
            $create_notification = Notification::insert($data);
            if(!$create_notification){
                return response()->json([ 'error' => 1, 'message' => __('dashboard.something_wrong'), ]);    
            }
            return response()->json([ 'error' => 0, 'message' => __('dashboard.added_successfully'), ]);

        } else {
            return response()->json([ 'error' => 1, 'message' => __('dashboard.no_audience') ]);
        }



        $update = Notification::where('notification_token', $request->notification_token)->update([
            'content' => $request->notification_content,
            'audience' => $request->notification_accounts,
            'language' => $request->notification_language,
        ]);

        if(!$update){
            return response()->json([
                'error' => 1,
                'message' => trans('dashboard.something_wrong'),
            ]);
        }

        return response()->json([
            'error' => 0,
            'message' => trans('dashboard.updated_successfully'),
        ]);

    }/* /update() */


    public function delete(Request $request){


        $deleteNotification = Notification::where('notification_token',$request->notification_token)->delete();
        if(!$deleteNotification){
            return response()->json([ 'error' => 1, 'message' => trans('dashboard.something_wrong'), ]);
        }
        return response()->json([ 'error' => 0, 'message' => trans('dashboard.deleted_successfully') ]);
    }/* /delete() */







































    
    public function notificationsCenter(Request $request){
        
        return view("notifications_center");

    }

    public function userNotifications(Request $request){

        if( auth()->check() ){
            $notifications = Notification::where('user_id', auth()->user()->id)->latest()->take(5)->get();

            if( $notifications->count() > 0 ){
                return response()->json([
                    'error' => 0,
                    'message' => 'found',
                    'notifications' => $notifications,
                ]);
            } else {
                return response()->json([
                    'error' => 1,
                    'message' => 'لا يوجد إشعارات حاليا',
                ]);
            }
        } else {
            return response()->json([
                'error' => 1,
                'message' => 'fail',
            ]);
        }
       
    }



    public function userOpenNotification(Request $request){

        $notification = Notification::find($request->id);
        $notification->seen = 1;
        
        $notification->save();

        return response()->json([
            'error' => 0,
            'message' => $notification,
        ]);

    }








}/* /CLASS */