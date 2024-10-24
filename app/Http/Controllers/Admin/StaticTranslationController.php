<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\FrontendPage;
use App\Models\Admin\StaticTranslation;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class StaticTranslationController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Static Translation Key Add', only: ['create']),
            new Middleware('permission:Static Translation View', only: ['index']),
            new Middleware('permission:Static Translation Update', only: ['edit']),
            new Middleware('permission:Static Translation Delete', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['items'] = StaticTranslation::where('lang_code', getSetting('default_language'))->get();
//        $data['items'] = StaticTranslation::all()->groupBy('key');
//        return $data;
        return view('backend.translation.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['frontend_pages'] = FrontendPage::where('status', 1)->get();
        return view('backend.translation.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $default_language = getSetting('default_language');
        $default_lang_value = 'value_'.$default_language;
        $request->validate([
            'key' => 'required|unique:static_translations,key',
            $default_lang_value => 'required',
            'page' => 'required',
        ]);

        $translation = StaticTranslation::create([
            'key'=> $request->key,
            'lang_code' => $default_language,
            'value' => $request->$default_lang_value,
        ]);

        foreach (json_decode(getSetting('site_language')) as $language){

            $value = 'value_' . $language;
            $translation = StaticTranslation::create([
                'key'=> $request->key,
                'lang_code' => $language,
                'value' => $request->$value == null ? $request->value_en: $request->$value,
            ]);

        }

        foreach ($request->page as $page){
            $frontend_page = FrontendPage::where('title', $page)->first();
            $keys =json_decode($frontend_page->translations);
            if($keys != null){
                array_push($keys, $request->key);
            }
            else{
                $keys = [$request->key];
            }
            $frontend_page->update([
                'translations' => $keys
            ]);
        }

        return redirect()->route('admin.static-translation.index')->with('success', 'Translation added successfully');
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
    public function edit(string $key)
    {
//        dd('ok');
        $data['item'] = StaticTranslation::where('key', $key)->get()->keyBy('lang_code');
        $data['item_ids'] = StaticTranslation::where('key', $key)->pluck('id')->toArray();
        $data['frontend_pages'] = FrontendPage::where('status', 1)->get();
        return view('backend.translation.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $default_language = getSetting('default_language');
        $default_lang_value = 'value_'.$default_language;
        $request->validate([
            $default_lang_value => 'required',
            'page' => 'required',
        ]);

        $key_default_translation = StaticTranslation::where('key', $request->key)->where('lang_code', $default_language)->first();
        if($key_default_translation != null){
            $value = 'value_' . $key_default_translation->lang_code;
            $key_default_translation->update([
                'value' => $request->$value == null ? $request->value_en: $request->$value,
            ]);
        }
        else{
            $value = 'value_' . $default_language;
            $key_default_translation = StaticTranslation::create([
                'key' => $request->key,
                'lang_code' => $default_language,
                'value' => $request->$value == null ? $request->value_en: $request->$value,
            ]);
        }

        foreach (json_decode(getSetting('site_language')) as $language){
            $key_translation = StaticTranslation::where('key', $request->key)->where('lang_code', $language)->first();
            if($key_translation != null){
                $value = 'value_' . $key_translation->lang_code;
                $key_translation->update([
                    'value' => $request->$value == null ? $request->value_en: $request->$value,
                ]);
            }
            else{
                $value = 'value_' . $language;
                $key_translation = StaticTranslation::create([
                    'key' => $request->key,
                    'lang_code' => $language,
                    'value' => $request->$value == null ? $request->value_en: $request->$value,
                ]);
            }
        }

        foreach (FrontendPage::all() as $page){
            if(!in_array($page->title, $request->page)){
                if($page->translations != null){
                    $keys = json_decode($page->translations);
                    if (in_array($request->key, $keys)){
                        $keys = array_diff($keys, [$request->key]);
                        $keys = array_values($keys);
                    }
                }
                else{
                    $keys = $page->translations;
                }
            }
            else{
                if($page->translations != null){
                    $keys = json_decode($page->translations);
                    if(!in_array($request->key, $keys)){
                        array_push($keys, $request->key);
                    }
//                    dd('nothing changed');
                }
                else{
                    $keys = [$request->key];
                }
            }
            $page->update([
                'translations' => $keys != null ? $keys: null,
            ]);
        }

        return redirect()->route('admin.static-translation.index')->with('success', 'Translation added successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        foreach (FrontendPage::all() as $page){
            if($page->translations != null){
                $keys = json_decode($page->translations);
                if (in_array($request->key, $keys)){
                    $keys = array_diff($keys, [$request->key]);
                    $keys = array_values($keys);
                }
            }
            else{
                $keys = $page->translations;
            }
            $page->update([
                'translations' => $keys != null ? $keys: null,
            ]);
        }
        StaticTranslation::where('key', $request->key)->delete();
        return redirect()->route('admin.static-translation.index')->with('success', 'Translation deleted successfully');
    }
}
