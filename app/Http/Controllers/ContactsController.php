<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Message;
use App\Events\NewMessage;


class ContactsController extends Controller
{
    
    public function get(Request $request){
        $contacts = User::where('id', '<>', auth()->user()->id)->get();
        return response()->json($contacts);
    }


    public function getMessagesFor($id){

        //$messages = Message::where('from', $id)->orWhere('to', $id)->get();

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
