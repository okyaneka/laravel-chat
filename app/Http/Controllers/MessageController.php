<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('chat');
    }

    public function read(User $receiver)
    {
        $messages = Message::where([
            ['sender_id', '=', auth()->user()->id],
            ['receiver_id', '=', $receiver->id],
        ])->orWhere([
            ['receiver_id', '=', auth()->user()->id],
            ['sender_id', '=', $receiver->id],
        ])
        ->get();

        return view('chat', compact('receiver', 'messages'));
    }
}
