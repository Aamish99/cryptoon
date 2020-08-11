<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use App\Models\Setting;
use Chumper\Zipper\Facades\Zipper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class SettingsController extends Controller
{

    public function __construct()
    {
        $this->middleware('demo', ['only' => ['updateSetting', 'addLanguage']]);
    }
    /*
    * General settings view
    ***********************/
    public function generalSetting(){
        return view('admin.settings.general');
    }

    /*
    * Update settings
    ***********************/
    public function updateSetting(Request $request){
        $this->validate($request, [
            'logo' => 'nullable|mimes:jpeg,bmp,png,gif',
            'title' => 'required|string|max:90',
            'site_url' => 'required',
            'copyright' => 'required|string|max:300',
            'description' => 'nullable|string|min:154|max:650',
            'facebook' => 'nullable',
            'twitter' => 'nullable',
            'linkedin' => 'nullable',
            'google_plus' => 'nullable',
            'instagram' => 'nullable',
        ]);
        if ($request->hasFile('site_logo')){
            $file      = $request->site_logo;
            $extention = $file->getClientOriginalExtension();
            $filename  = time().'-logo.'.$extention;
            $file->move('assets/img', $filename);
            Setting::where('key', 'logo')->update(['value' => $filename]);
        }
        if($request->has('title'))
            Setting::where('key', 'site_title')->update(['value' => $request->title]);

        if($request->has('site_url'))
            Setting::where('key', 'site_url')->update(['value' => $request->site_url]);

        if($request->has('language'))
            Setting::where('key', 'language')->update(['value' => $request->language]);

        if($request->has('copyright'))
            Setting::where('key', 'copyright')->update(['value' => $request->copyright]);

        if($request->has('keywords'))
            Setting::where('key', 'keywords')->update(['value' => $request->keywords]);

        if($request->has('description'))
            Setting::where('key', 'description')->update(['value' => $request->description]);

        if($request->has('analytics'))
            Setting::where('key', 'analytics')->update(['value' => $request->analytics]);

        if($request->has('captcha_status'))
            Setting::where('key', 'captcha_status')->update(['value' => $request->captcha_status]);
        else
            Setting::where('key', 'captcha_status')->update(['value' => 'off']);

        if($request->has('site_key'))
            Setting::where('key', 'site_key')->update(['value' => $request->site_key]);

        if($request->has('facebook'))
            Setting::where('key', 'facebook')->update(['value' => $request->facebook]);

        if($request->has('twitter'))
            Setting::where('key', 'twitter')->update(['value' => $request->twitter]);

        if($request->has('instagram'))
            Setting::where('key', 'instagram')->update(['value' => $request->instagram]);

        if($request->has('linkedin'))
            Setting::where('key', 'linkedin')->update(['value' => $request->linkedin]);

        if($request->has('google_plus'))
            Setting::where('key', 'google_plus')->update(['value' => $request->google_plus]);

        return redirect()->back()->withStatus(__('lang.settings_updated_successfully'));
    }

    /*
    * Get list of languages
    ***********************/
    public function language(){
        $languages = Language::all();
        return view('admin.settings.language', compact('languages'));
    }

    /*
    * Add new languages
    ***********************/
    public function addLanguage(Request $request){

        $this->validate($request, [
            'zip_file' => 'required',
            'name' => 'required|string|max:90',
            'short_name' => 'required|string|max:90|alpha_dash',
        ]);
        $language = Language::where('short_name', $request->short_name)->first();
        if($language == null){
            $language = new Language();
        }
        $language->name = $request->name;
        $language->short_name = $request->short_name;
        $language->status = true;
        if ($request->hasFile('zip_file')){
            $e_path = base_path('resources/lang/'.$language->short_name);
            if(!(is_dir($e_path))){
                if (!mkdir($e_path, 0, true)) {
                    return redirect()->back()->withErrors('Language folder not created. Please set 777 permission to resources/lang folder');
                }
            }
            $file      = $request->zip_file;
            $filename = $file->getClientOriginalName();
            $file->move('uploads', $filename);
            $path = 'uploads/'.$filename;
            $notLogFiles = Zipper::make($path)->listFiles('/^(?!.*\.log).*$/i');

            if(!(in_array($language->short_name.'/lang.php', $notLogFiles, TRUE))){
                File::delete('uploads/' . $filename);
                return redirect()->back()->withErrors('Zip file must have the folder with language short name and it should have lang.php file');
            }

            Zipper::make($path)->folder($language->short_name)->extractTo($e_path);
            Zipper::make($path)->close();
            File::delete('uploads/' . $filename);
            $language->lang_file = $filename;

        }
        $language->save();
        return redirect()->back()->withStatus(__('lang.language_added_successfully'));
    }

    /*
    * Download languages files
    ***********************/
    public function downloadLanguage($id){
        $language =  Language::find($id);
        $files = glob(base_path('resources/lang/'.$language->short_name.'/*'));
        File::delete('uploads/'.$language->lang_file);
        Zipper::make('uploads/'.$language->lang_file)->folder($language->short_name)->add($files)->close();
        return response()->download('uploads/'.$language->lang_file);
    }

    /*
    * change website language
    ***********************/
    public function switchLanguage(Request $request){
      /*  $languages = Language::all();
        if(isset($languages)){
            foreach ($languages as $language){
                $lang = Language::find($language->id);
                if($request->short_name == $language->short_name){
                    $lang->default = true;
                    Session::put('locale', $request->short_name);
                }
                else{
                    $lang->default = false;
                }
                $lang->save();
            }
        }
        return 'true';*/
      return 'demo';
    }

    /*
    * Delete language
    ***********************/
    public function destroyLanguage(Request $request){
        /*$e_path = base_path('resources/lang');
        foreach ($request->id as $item){
            $language =  Language::find($item);
            if($language){
                File::deleteDirectory($e_path.'/'.$language->short_name);
                $language->delete();

            }
        }
        return __('lang.language_delete_success');*/
        return 'demo';
    }
}
