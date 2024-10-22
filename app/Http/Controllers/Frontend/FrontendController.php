<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\ChatUser;
use App\Models\Frontend\LiveChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index(){
        return view('frontend.home.index');
    }

    public function contact()
    {
        return view('frontend.contact.index');
    }

    public function support()
    {
        return view('frontend.support.index');
    }

    public function chat()
    {
        $chat_user = ChatUser::where('user_id', Auth::id())->first();
        if (!$chat_user) {
            $data['item'] = ChatUser::create([
                'user_id' => Auth::id(),
                'status' => 1,
            ]);
        }
        else{
            $data['item'] = $chat_user;
        }

        return view('frontend.live_chat.chat', $data);
    }
}
