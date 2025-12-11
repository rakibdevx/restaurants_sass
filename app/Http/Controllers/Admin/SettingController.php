<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.setting.index');
    }

    public function update(Request $request)
    {
        Setting::updateOrCreate(['key'=>'site_title'], ['value'=>$request->site_title]);
        Setting::updateOrCreate(['key'=>'site_url'], ['value'=>$request->site_url]);
        Setting::updateOrCreate(['key'=>'site_tagline'], ['value'=>$request->site_tagline]);


        Cache::forget('settings_cache');

        return back()->with('success', 'Settings updated successfully!');
    }

    public function image()
    {
        return view('admin.setting.image');
    }

    public function image_update(Request $request)
    {
        $images = ['site_logo','site_dark_logo','site_favicon','default_profile_image'];

        foreach ($images as $imageKey) {

            if ($request->hasFile($imageKey)) {
                $old = setting($imageKey);

                if ($old && file_exists(public_path($old))) {
                    unlink(public_path($old));
                }

                $file = $request->file($imageKey);
                $filename = $imageKey . '_' . time() . '.' . $file->getClientOriginalExtension();

                $path = 'uploads/settings/' . $filename;
                $file->move(public_path('uploads/settings'), $filename);

                Setting::updateOrCreate(['key'=>$imageKey], ['value'=>$path]);
            }
        }


        Cache::forget('settings_cache');

        return back()->with('success', 'Image updated successfully!');
    }



}
