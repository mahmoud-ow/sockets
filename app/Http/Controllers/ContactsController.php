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
        
        // get all users except the auth()
      
        $contacts = User::where('id', '<>', auth()->user()->id)->get();

        $unreadIds = Message::select(DB::raw('`from` as sender_id, count(`from`) as messages_count'))
        ->where('to', auth()->id())
        ->where('read', false)
        ->groupBy('from')
        ->get();
        

        // get conversations
        $conversations = Message::where(function($query){
            $query->where('to', auth()->id())->orWhere('from', auth()->id());
        })
        ->groupBy('to')
        ->groupBy('from')
        ->get();


        return $conversations;

       

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