<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Message;
use App\Events\NewMessage;
use DB;

class ContactsController extends Controller
{
    
    public function get(Request $request){
        

        $from_ids = Message::selectRaw(' MAX(`id`) as rowid, `to` , `from` ')->where( 'to' , auth()->id() )->orderBy('rowid', 'asc')->groupBy('to', 'from')->get();
        $to_ids = Message::selectRaw(' MAX(`id`) as rowid, `to` , `from` ')->where( 'from' , auth()->id() )->orderBy('rowid', 'asc')->groupBy('to', 'from')->get();


        return $from_ids ."<hr/>". $to_ids;

        
        $valid_users = array();
        foreach( $to_ids as $to_user ){
            $valid_users[$to_user->rowid] = $to_user->to;
        }
        foreach( $from_ids as $from_user ){
            $valid_users[$from_user->rowid] = $from_user->from;
        }
        $valid_users = array_values($valid_users);
        $valid_users = array_reverse($valid_users);       
        $contact_list = [];

        foreach( $valid_users as $user ){
            if( !in_array($user, $contact_list) ){
                $contact_list[] = $user;
            }
        }


     


        /* $contact_list = [];
        foreach($valid_users as $key => $value ){
            $contact_list[] = $value;
        } */

        //array_unique( $contact_list , SORT_REGULAR);;

        //$contact_list = array_unique($contact_list);

        
        


        // get all users except the auth()
        $contacts = User::where('id', '<>', auth()->user()->id)->whereIn('id', $contact_list)->get();



        $ids = collect($contact_list);

        $contacts = $ids->map(function($id) use($contacts) {
            return $contacts->where('id', $id)->first();
        });




        $unreadIds = Message::select(DB::raw('`from` as sender_id, count(`from`) as messages_count'))
        ->where('to', auth()->id())
        ->where('read', false)
        ->groupBy('from')
        ->get();


        // add an unread key to each contact with the count of unread messages
        $contacts = $contacts->map(function($contact) use ($unreadIds) {
            $contactUnread = $unreadIds->where('sender_id', $contact->id)->first();

            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;

            return $contact;
        });


        return response()->json($contacts);
    }


    public function getMessagesFor($id){

        // mark all messages with the selected contact as read
        Message::where('from', $id)->where('to', auth()->id())->update(['read' => true]);

        
        $messages = Message::where(function($q) use($id) {
            $q->where('from', auth()->id());
            $q->where('to', $id);
        })->orWhere(function($q) use($id){
            $q->where('from', $id);
            $q->where('to', auth()->id());
        })
        ->get();

        return response()->json($messages);
    }



    public function send(Request $request){
        $message = Message::create([
            'from' => auth()->user()->id,
            'to' => $request->contact_id,
            'text' => $request->text,
        ]);

        broadcast( new NewMessage($message) );

        return response()->json($message);
    }


}/* /CLASS */