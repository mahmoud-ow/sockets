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
        

        $from_ids = Message::selectRaw(' MAX(`id`) as rowid, `to` , `from` ')->where( 'to' , auth()->id() )->orderBy('rowid', 'desc')->groupBy('to', 'from')->get();
        $to_ids = Message::selectRaw(' MAX(`id`) as rowid, `to` , `from` ')->where( 'from' , auth()->id() )->orderBy('rowid', 'desc')->groupBy('to', 'from')->get();
        
        $convs = Message::selectRaw(' MAX(`id`) as rowid, `to` , `from` ')->where( 'from' , auth()->id() )->orWhere('to', auth()->id())->orderBy('rowid', 'desc')->groupBy('to', 'from')->get();

        
        $ids = [];

        foreach($convs as $conv){
            if($conv->to != auth()->id()){
                $ids[] = $conv->to;        
            } else {
                $ids[] = $conv->from;        
            }
        }
        

        $fixedIds = [];
        
        foreach( $ids as $id ){
            if( !in_array( $id, $fixedIds ) ){
                $fixedIds[] = $id;
            }
        }

        

        // get all users except the auth()
        $contacts = User::where('id', '<>', auth()->user()->id)->whereIn('id', $fixedIds)->get();



        $ids = collect($fixedIds);

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
            // set images
            $contact->profile_image = ( $contact->getMedia('avatar')->first() ) ? $contact->getMedia('avatar')->first()->getUrl('thumb') : 'images/dashboard/profile-default-image.png' ;
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
        $user = User::find(auth()->id());

        broadcast( new NewMessage($message, $user) );

        return response()->json($message);
    }


}/* /CLASS */