<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Country;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Str;

class CountryController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Country Add', only: ['create']),
            new Middleware('permission:Country View', only: ['index']),
            new Middleware('permission:Country Update', only: ['edit']),
            new Middleware('permission:Country Delete', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['items'] = Country::orderBy('name', 'asc')->get();
        return view('backend.country.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.country.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        return $request;
        $request->validate([
            'name' => 'required|unique:countries|max:100',
            'iso2' => 'required|unique:countries|max:2',
            'phonecode' => 'required|unique:countries|max:3',
            'currency' => 'required',
            'currency_name' => 'required',
            'currency_symbol' => 'required',
            'language' => 'required',
            'lang_code' => 'required',
            'conversion_rate_to_tk' => 'required',
        ],[
        'iso2.unique' => 'Country code already exist.',
            ]);
//        dd('ok');
        $request->merge([
            'iso2' => Str::title($request->iso2)
        ]);
        Country::create($request->all());
        return redirect()->route('admin.country.index')->with('success', 'Country added successfully.');
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
        $data['item'] = Country::findOrFail($id);
        return view('backend.country.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'iso2' => 'required',
            'phonecode' => 'required',
            'currency' => 'required',
            'currency_name' => 'required',
            'currency_symbol' => 'required',
            'language' => 'required',
            'lang_code' => 'required',
            'conversion_rate_to_tk' => 'required',
        ]);
        $country = Country::findOrFail($request->id);

        if ($request->name != $country->name) {
            $request->validate([
                'name' => 'unique:countries',
            ]);
        }
        if ($request->iso2 != $country->iso2) {
            $request->validate([
                'iso2' => 'unique:countries',
            ], [
                'iso2.unique' => 'Country code already exist.',
            ]);
        }
        if ($request->phonecode != $country->phonecode) {
            $request->validate([
                'phonecode' => 'unique:countries',
            ]);
        }

        $country->update($request->all());
        return redirect()->route('admin.country.index')->with('success', 'Country updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Country::destroy($request->id);
        return redirect()->route('admin.country.index')->with('success', 'Country deleted successfully.');
    }
}
