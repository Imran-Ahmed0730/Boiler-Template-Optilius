<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Page;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Str;

class PageController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Page Create', only: ['create']),
            new Middleware('permission:Page View', only: ['index']),
            new Middleware('permission:Page Update', only: ['edit']),
            new Middleware('permission:Page Delete', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['items'] = Page::orderBy('title', 'asc')->get();
        return view('backend.page.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.page.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:pages',
            'description' => 'required',
        ]);

        Page::create([
            'title'     => $request->title,
            'slug'      => Str::slug($request->title),
            'content'   => $request->description,
            'status'    => $request->status,
        ]);

        return redirect()->route('admin.page.index')->with('success', 'Page created successfully');
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
    public function edit(string $slug)
    {
        $data['item'] = Page::where('slug', $slug)->firstOrFail();
        return view('backend.page.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $page = Page::where('slug', $request->slug)->firstOrFail();
        if($request->title != $page->title){
            $request->validate([
                'title' => 'unique:pages',
            ]);
        }

        $page->update([
            'title'     => $request->title,
            'slug'      => Str::slug($request->title),
            'content'   => $request->description,
            'status'    => $request->status
        ]);

        return redirect()->route('admin.page.index')->with('success', 'Page updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Page::where('id', $request->id)->delete();
        return redirect()->route('admin.page.index')->with('success', 'Page deleted successfully');
    }
}
