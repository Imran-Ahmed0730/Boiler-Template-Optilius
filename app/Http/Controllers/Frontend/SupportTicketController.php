<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Staff;
use App\Models\Frontend\SupportContent;
use App\Models\Frontend\SupportFile;
use App\Models\Frontend\SupportTicket;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Session;

class SupportTicketController extends Controller implements HasMiddleware
{
    /**
     * Display a listing of the resource.
     */

    public static function middleware():array
    {
        return [
            new Middleware('permission:Support View', only: ['index']),
            new Middleware('permission:Support Chat View', only: ['chat']),
            new Middleware('permission:Support Chat', only: [ 'update']),
            new Middleware('permission:Support Close', only: [ 'close']),
            new Middleware('permission:Support Open', only: [ 'open']),
            new Middleware('permission:Support Chat Assignment', only: [ 'assign']),
        ];
    }

    public function index()
    {
        if (Auth::check() && Auth::user()->role == 1 || Auth::user()->role == 4) {
            $data['items'] = SupportTicket::latest()->get();
            $data['staffs'] = Staff::where('status', 1)->get();
            return view('backend.support.list', $data);
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
//        return $request;
        $request->validate([
            'subject' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'g-recaptcha-response' => ['required', function (string $attribute, mixed $value, Closure $fail): void
            {
                $g_response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                    'secret' => config('services.recaptcha.secret_key'),
                    'response' => $value,
//                    'remoteip' => $request->ip(),
                ]);
//                dd($g_response->json());

                if (!$g_response->json('success')) {
                    $fail('reCAPTCHA validation failed, please try again.');
                }
            }
            ],
        ]);

        if (Auth::check() && Auth::user()->role == 3){
            $user_id = Auth::user()->id;
        }
        $last_support_id = SupportTicket::orderBy('id', 'desc')->first();
        if($last_support_id == null){
            $last_support_id = 1;
        }
        else{
            $last_support_id = $last_support_id->id + 1;
        }

        $data['item'] = SupportTicket::create([
            'user_id' => $user_id ?? null,
            'token' => 'ST'.str_pad($last_support_id, 8, '0', STR_PAD_LEFT),
            'email' => $request->email,
            'subject' => $request->subject,
            'status' => 1,
        ]);
        SupportContent::create([
            'support_ticket_id' => $data['item']->id,
            'message' => $request->message,
            'sent_by' => Auth::user()->role ?? 0,
        ]);
        Session::put('verify_chat', 1);

        return redirect()->route('support.chat.public', $data['item']->token)->with('success', 'Support ticket created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
//        dd($request);
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
        ]);

        $support = SupportTicket::where('email', $request->email)->where('token', $request->token)->first();
        if ($support ) {
            if ($support->status == 0) {
                return back()->with('error', 'Support ticket already closed');
            }
            Session::put('verify_chat', 1);
            return redirect()->route('support.chat.public', [$support->token]);
        }
        else{
            return back()->with('error', 'Sorry! There is no support ticket with that email and token');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
//        return $request;
//        return response()->json($request);
        if($request->image != null) {
            $request->validate([
                'image' => 'array',
                'image.*' => 'image|mimes:jpeg,png,jpg',
            ]);
        }
        if($request->file != null) {
            $request->validate([
                'file' => 'mimes:pdf,doc,docx,xls,txt,xlsx|max:2048',
            ]);
        }
        $content = SupportContent::create([
            'support_ticket_id' => $request->support_ticket_id,
            'message' => $request->message,
            'sent_by' => Auth::user()->role ?? 0,
        ]);
        if($request->image != null){
            for($i = 0; $i < count($request->image); $i++){
                $imagePath = saveImagePath($request->file('image')[$i], 'support/image');
                SupportFile::create([
                    'support_content_id' => $content->id,
                    'file_path' => $imagePath,
                    'type' => 1,
                ]);
            };
        }
        if($request->file != null){
            $filePath = saveImagePath($request->file('file'), 'support/file');
            SupportFile::create([
                'support_content_id' => $content->id,
                'file_path' => $filePath,
                'type' => 2,
            ]);
        }
        $image = SupportFile::where('support_content_id', $content->id)->where('type', 1)->get();
        $file = SupportFile::where('support_content_id', $content->id)->where('type', 2)->get();
        return response()->json([$content, $image, $file]);
//        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }

    public function chat($id)
    {
        $data['item'] = SupportTicket::findOrFail($id);
        return view('backend.support.chat', $data);
    }

    public function publicChat($token)
    {
        if(Session::get('verify_chat') == 1){
            $data['item'] = SupportTicket::where('token', $token)->first();
            if ($data['item']) {
                return view('frontend.support.chat', $data);
            }
            else{
                return back()->with('error', 'Sorry! There is no support ticket with that token');
            }
        }
        else{
            return redirect()->route('support');
        }

    }

    public function publicUpdate(Request $request)
    {
        if($request->image != null) {
            $request->validate([
                'image' => 'array',
                'image.*' => 'image|mimes:jpeg,png,jpg',
            ]);
        }
        if($request->file != null) {
            $request->validate([
                'file' => 'mimes:pdf,doc,docx,xls,txt,xlsx|max:2048',
            ]);
        }
        $content = SupportContent::create([
            'support_ticket_id' => $request->support_ticket_id,
            'message' => $request->message,
            'sent_by' => Auth::user()->role ?? 0,
        ]);
        if($request->image != null){
            for($i = 0; $i < count($request->image); $i++){
                $imagePath = saveImagePath($request->file('image')[$i], 'support/image');
                SupportFile::create([
                    'support_content_id' => $content->id,
                    'file_path' => $imagePath,
                    'type' => 1,
                ]);
            };
        }
        if($request->file != null){
            $filePath = saveImagePath($request->file('file'), 'support/file');
            SupportFile::create([
                'support_content_id' => $content->id,
                'file_path' => $filePath,
                'type' => 2,
            ]);
        }
        $image = SupportFile::where('support_content_id', $content->id)->where('type', 1)->get();
        $file = SupportFile::where('support_content_id', $content->id)->where('type', 2)->get();
        return response()->json([$content, $image, $file]);
//        return back();
    }

    public function close(string $id)
    {
        SupportTicket::where('id',$id)->first()->update([
            'status' => 0
        ]);
        return back()->with('success', 'Support ticket has been closed');
    }

    public function open(string $id)
    {
        SupportTicket::where('id',$id)->first()->update([
            'status' => 1
        ]);
        return back()->with('success', 'Support ticket has been opened');
    }

    public function assign(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'staff_id' => 'required',
        ]);

        if($request->staff_id == 0){
            $request->staff_id = null;
        }

        SupportTicket::where('id', $request->id)->first()->update([
            'assigned_to' => $request->staff_id
        ]);
        return back()->with('success', 'Support ticket has been assigned');
    }
}
