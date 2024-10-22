<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\UserMessage;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Http;

class UserMessageController extends Controller implements HasMiddleware
{
    /**
     * Display a listing of the resource.
     */
    public static function middleware(): array
    {
        return[
            new Middleware('permission:Message View', only: ['index']),
        ];
    }

    public function index()
    {
        $data['items'] = UserMessage::latest()->get();
        return view('backend.user_message.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'message' => ['required'],
            'name' => ['required'],
            'email' => ['required', 'email'],
            'subject' => ['required'],
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

        // Store form data
        UserMessage::create($request->only('name', 'email', 'subject', 'message'));
        return back()->with('success', 'Message has been sent.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        UserMessage::destroy($request->id);
        return back()->with('success', 'Message Deleted Successfully');
    }
}
