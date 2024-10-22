<?php

namespace App\Http\Controllers\Frontend;

use App\Events\SendAdminMessage;
use App\Events\SendUserMessage;
use App\Http\Controllers\Controller;
use App\Models\Admin\Staff;
use App\Models\Frontend\ChatUser;
use App\Models\Frontend\LiveChat;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class LiveChatController extends Controller
{
    public static function middleware():array
    {
        return [
            new Middleware('permission:Live Chat List View', only: ['index']),
            new Middleware('permission:Live Chat View', only: ['chat']),
            new Middleware('permission:Live Chat', only: [ 'update']),
            new Middleware('permission:Live Chat Assignment', only: [ 'assign']),
        ];
    }

    public function index()
    {
        if (Auth::check() && Auth::user()->role == 1 || Auth::user()->role == 4) {
            $data['items'] = ChatUser::latest()->get();
            $data['staffs'] = Staff::where('status', 1)->get();
            return view('backend.live_chat.list', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'message' => 'required',
            'chat_user_id' => 'required',
        ]);

        $data = LiveChat::create([
            'sent_by' => Auth::user()->role,
            'chat_user_id' => $request->chat_user_id,
            'message' => $request->message ?? null,
        ]);

        if (Auth::user()->role == 1 || Auth::user()->role == 4){
            broadcast(new SendAdminMessage($data))->toOthers();
        }
        else{
            event(new SendUserMessage($data));
        }

        return response()->json([$data]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }

    public function chat($id)
    {
        $data['item'] = ChatUser::findOrFail($id);
        return view('backend.live_chat.chat', $data);
    }


    public function assign(Request $request)
    {
        return $request;
        $request->validate([
            'id' => 'required',
            'staff_id' => 'required',
        ]);

        if($request->staff_id == 0){
            $request->staff_id = null;
        }

        ChatUser::where('id', $request->id)->first()->update([
            'assigned_to' => $request->staff_id
        ]);
        return back()->with('success', 'Live chat has been assigned');
    }
}
