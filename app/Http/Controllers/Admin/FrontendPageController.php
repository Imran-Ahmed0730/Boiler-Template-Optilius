<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\FrontendPage;
use App\Models\Admin\StaticTranslation;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class FrontendPageController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Frontend-Page Add', only: ['create']),
            new Middleware('permission:Frontend-Page View', only: ['index']),
            new Middleware('permission:Frontend-Page Update', only: ['edit']),
            new Middleware('permission:Frontend-Page Delete', only: ['destroy']),
            new Middleware('permission:Static Translation Page View', only: ['translation']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['items'] = FrontendPage::orderBy('title', 'asc')->get();
        return view('backend.frontend-page.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.frontend-page.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:frontend_pages|max:255',
        ]);
        FrontendPage::create($request->all());
        return redirect()->route('admin.frontend-page.index')->with('success', 'Frontend page added successfully');
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
        $data['item'] = FrontendPage::findOrFail($id);
        return view('backend.frontend-page.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);
        $frontend_page = FrontendPage::findOrFail($request->id);
        $frontend_page->update($request->all());
        return redirect()->route('admin.frontend-page.index')->with('success', 'Frontend page updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        FrontendPage::where('id', $request->id)->delete();
        return back()->with('success', 'Frontend page deleted successfully');
    }

    public function translation($id)
    {
        $page = FrontendPage::findOrFail($id);
        if($page->translations != null){
            $keys = json_decode($page->translations);
            $data['items'] =  StaticTranslation::whereIn('key', $keys)->get()->groupby('key');

        }
        else{
            $data['items'] = null;
        }
        $data['page'] = $page;
        return view('backend.frontend-page.translation', $data);
    }
}
