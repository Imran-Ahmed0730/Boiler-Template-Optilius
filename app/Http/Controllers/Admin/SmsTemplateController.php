<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\SmsTemplate;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class SmsTemplateController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return[
            new Middleware('permission:Sms Template Add', only: ['create']),
            new Middleware('permission:Sms Template View', only: ['index']),
            new Middleware('permission:Sms Template Update', only: ['edit']),
            new Middleware('permission:Sms Template Delete', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['items'] = SmsTemplate::all();
        return view('backend.sms_template.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.sms_template.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:sms_templates',
            'body' => 'required',
        ]);
        SmsTemplate::create($request->all());
        return redirect()->route('admin.sms-template.index')->with('success', 'Sms Template created successfully.');
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
        $data['item'] = SmsTemplate::findOrFail($id);
        return view('backend.sms_template.form', $data);
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
        $sms_template = SmsTemplate::findOrFail($request->id);

        if($request->title != $sms_template->title) {
            $request->validate([
                'title' => 'unique:sms_templates',
            ]);
        }

//        $request->body = implode(' ', $request->body);
        $sms_template->update([
            'title' => $request->title ?? $sms_template->title,
            'body' => $request->body ?? $sms_template->body,
        ]);
        return redirect()->route('admin.sms-template.index')->with('success', 'Sms Template updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        SmsTemplate::where('id', $request->id)->delete();
        return redirect()->route('admin.sms-template.index')->with('success', 'Sms Template deleted successfully.');
    }
}
