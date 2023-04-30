<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(){
        return view('chat');
    }

    public function fetchMessages(){
        return Message::query()->with(['user' => function($query){
            return $query->select('id', 'full_name');
        }])->get();
    }
  
    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'subject'=> 'required',
            'creator_id'=> 'numeric',
            'image'=> 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'parent_message_id'=> 'nullable|numeric',
            'created_at'=> 'required',
            'full_name'=> 'required',
        ]);

       if(isset($validated['image'])){
            $imageName = time().'.'.$validated['image']->extension();  
            $validated['image']->move(storage_path('app/public/images/'), $imageName);
            $validated['image'] = '/images/' . $imageName;
       }

        $message = new Message($validated);

        $message->save();
        $result = $validated;
        $result['id'] = $message->id;
        $result['user'] = [
            'full_name' => $validated['full_name'],
            'id' => $validated['creator_id'],
        ];

        MessageSent::dispatch($result);
        
        return [
            'status' => 'Message Sent!',
            'message_id' => $message->id,
        ];
    }
}



