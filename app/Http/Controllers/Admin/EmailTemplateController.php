<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\EmailTemplate;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;

class EmailTemplateController extends Controller
{
    public static function middleware(): array
    {
        return[
            new Middleware('permission:Email Template Add', only: ['create']),
            new Middleware('permission:Email Template View', only: ['index']),
            new Middleware('permission:Email Template Update', only: ['edit']),
            new Middleware('permission:Email Template Delete', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['items'] = EmailTemplate::latest()->get();
        return view('backend.email_template.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.email_template.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:email_templates',
            'body' => 'required',
        ]);
        EmailTemplate::create($request->all());
        return redirect()->route('admin.email-template.index')->with('success', 'Email Template created successfully.');
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
        $data['item'] = EmailTemplate::findOrFail($id);
        return view('backend.email_template.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
//        return $request;
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        $email_template = EmailTemplate::findOrFail($request->id);

        if ($request->title != $email_template->title) {
            $request->validate([
                'title' => 'unique:email_templates',
            ]);
        }

//        $request->body = implode(' ', $request->body);
        $email_template->update([
            'title' => $request->title ?? $email_template->title,
            'body' => $request->body ?? $email_template->body,
        ]);
        return redirect()->route('admin.email-template.index')->with('success', 'Email Template updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        EmailTemplate::where('id', $request->id)->delete();
        return redirect()->route('admin.email-template.index')->with('success', 'Email Template deleted successfully.');
    }
}
