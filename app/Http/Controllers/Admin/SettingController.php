<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Country;
use App\Models\Admin\Setting;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Str;

class SettingController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:Settings Update',only: ['goToSection']),
        ];
    }

    public function create(){
        return view('backend.setting.form');
    }
    public function store(Request $request){
        $request->validate([
            'key' => 'required|unique:settings',
            'value' => 'required'
        ]);
        Setting::create($request->all());
        return redirect()->route('admin.setting.index')->with('success','Setting created successfully');
    }
    //
    public function index(){
        $data['items'] = Setting::latest()->get();
        return view('backend.setting.list',$data);
    }

    public function edit(){
//        return view('backend.setting.index');
        return redirect()->route('admin.setting.section', 'site');
    }

    public function update(Request $request){
//        return $request;
        $prev_url = url()->previous();
        if(Str::contains($prev_url, 'contact')){
            $request->validate([
                'email'     => 'required',
                'phone'     => 'required',
                'whatsapp'  => 'required',
            ]);
        }
        elseif (Str::contains($prev_url, 'site')){
            $request->validate([
                'site_name'         => 'required',
                'business_name'     => 'required',
                'site_url'          => 'required',
                'short_bio'         => 'required',
                'meta_description'  => 'required',
            ]);
        }

        elseif (Str::contains($prev_url, 'user')){
            $request->validate([
                'user_verification' => 'required',
            ]);
        }


        $settings = Setting::all();
        foreach ($settings as $setting) {
            if($setting->key == 'site_logo' || $setting->key == 'site_footer_logo' || $setting->key == 'site_dark_logo' || $setting->key == 'site_favicon'){
                if ($request->hasFile($setting->key)) {
                    $request->validate([
                        $setting->key => 'mimes:jpeg,png,jpg',
                    ]);
                    $image = $request->file($setting->key);
                    $imagePath = updateImagePath($image, $setting->value, 'website-image' );

                }
                else{
                    $imagePath = $setting->value;
                }
                $setting->value = $imagePath;
            }
            elseif ($setting->key != 'developed_by' || $setting->key != 'developed_by_url'){
                if ($setting->key == 'site_language'){
                    // Decode the existing languages from JSON
                    $languages = json_decode($setting->value, true); // true for associative array
                    // Merge with new languages from the request
                    $newLanguages = $request->input($setting->key, []); // Default to empty array if not present
                    $mergedLanguages = array_unique(array_merge($languages, $newLanguages)); // Merge and remove duplicates

                    $setting->value = $mergedLanguages;
                }
                elseif ($request->input($setting->key) !== null){
                    $setting->value = $request->input($setting->key);
                }
                elseif (Str::contains($prev_url, 'store')){
                    if($setting->key == 'address' || $setting->key == 'shop_map_location' || $setting->key == 'opening_time' || $setting->key == 'closing_time' || $setting->key == 'closed_on') {
                        $setting->value = $request->input($setting->key) ?? null;
                    }
                }

            }
            else{
                $setting->value = $request->input($setting->key);
            }

            $setting->save();
        }

        return back()->with('success', 'Settings updated successfully');

    }

    public function goToSection($slug)
    {
        $data[] = null;
        $view = 'index';
        $permissions = [
            'site' => 'Settings Site',
            'user' => 'Settings User',
            'contact' => 'Settings Contact',
            'logos-favicon' => 'Settings Logo & Favicon',
            'social-media' => 'Settings Social Media',
            'store' => 'Settings Store',
            'language' => 'Settings Language',
        ];

        // Check if the current user has the required permission
        if (array_key_exists($slug, $permissions) && !auth()->user()->can($permissions[$slug])) {
            abort(403, 'User does not have the right permissions.');
        }
        if($slug == 'site'){
            $view = 'index';
        }
        elseif ($slug == 'contact'){
            $view = 'contact';
        }
        elseif ($slug == 'logos-favicon'){
            $view = 'logo_favicon';
        }
        elseif ($slug == 'social-media'){
            $view = 'social_media';
        }
        elseif ($slug == 'user'){
            $view = 'user';
        }
        elseif ($slug == 'store'){
            $view = 'store';
        }
        elseif ($slug == 'language'){
            $view = 'language';
            $data['languages'] = Country::select('lang_code', 'language')
                ->where('language', '!=', null)
                ->where('lang_code', "!=", null)
                ->distinct('lang_code')->orderBy('language', 'asc')
                ->get();
        }
        else{
            return redirect()->route('admin.setting.edit', 'site');
        }

        return view('backend.setting.'.$view, $data);
    }

    public function removeLanguage(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'lang_code' => 'required|string',
        ]);

        // Assuming you have the setting
        $setting = Setting::where('key', 'site_language')->first();

        if ($setting) {
            $languages = json_decode($setting->value, true);

            // Remove the language code from the array
            if (($key = array_search($request->lang_code, $languages)) !== false) {
                unset($languages[$key]); // Remove it from the array
            }

            // Update the setting with the new languages
            $setting->value = json_encode(array_values($languages)); // Use array_values to reindex the array
            $setting->save(); // Save the changes

            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error'], 500);
    }


}
