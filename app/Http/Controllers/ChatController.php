<?php

namespace App\Http\Controllers;

use App\Events\MessageEvent;
use App\Models\PublicMessages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class ChatController extends Controller
{
    private $req;
    public function __construct(Request $req)
    {
        $this->req = $req;
    }

    public function getLastPublicMessages()
    {
        $publicMessages = PublicMessages::latest()->take(100)->get();
        return response()->json(['dados' => $publicMessages, "message" => "sucesso"], 200);

    }
    public function publicChat()
    {
        $user = auth()->user();
        $message = $this->req->message;

        $publicMessage = PublicMessages::create([
            "user_id" => $user->id,
            "message" => $message
        ]);

        Event::dispatch(new MessageEvent($publicMessage));
        return response()->json(['dados' => $publicMessage, "message" => "sucesso"], 200);
    }
}
