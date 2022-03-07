<?php

namespace App\Http\Controllers\Backend;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Seo;
use Intervention\Image\Facades\Image;

class SettingController extends Controller
{
    public function SiteSetting()
    {
        $site_setting = SiteSetting::find(1);
        return view('backend.setting.siteSetting',compact('site_setting'));
    }

    public function UpdateSiteSetting(Request $request){
        $site_setting = SiteSetting::find(1);

        if ($request->hasfile('logo')) {
            @unlink(public_path($site_setting->logo));
            $image = $request->file('logo');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(139, 36)->save('upload/site-logo/' . $name_gen);
            $save_url = 'upload/site-logo/' . $name_gen;
        }

        $site_setting->logo = isset($save_url)? $save_url: null;
        $site_setting->email = $request->email;
        $site_setting->phone_one = $request->phone_one;
        $site_setting->phone_two = $request->phone_two;
        $site_setting->company_name = $request->company_name;
        $site_setting->company_address = $request->company_address;
        $site_setting->facebook = $request->facebook;
        $site_setting->twitter = $request->twitter;
        $site_setting->twitter = $request->twitter;
        $site_setting->linkedin = $request->linkedin;
        $site_setting->youtube = $request->youtube;
        $site_setting->save();

        $notification = array(
            'message' => 'the Changes Saved Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function SeoSetting(){
        $seo_setting = Seo::find(1);
        return  view('backend.setting.seoSetting',compact('seo_setting'));
    }


    public function UpdateSeoSetting(Request $request){

        $seo_setting = Seo::find(1);
        $seo_setting->meta_title = $request->meta_title;
        $seo_setting->meta_author = $request->meta_author;
        $seo_setting->meta_keyword = $request->meta_keyword;
        $seo_setting->meta_description = $request->meta_description;
        $seo_setting->google_analytics = $request->google_analytics;
        $seo_setting->save();

        $notification = array(
            'message' => 'the Changes Saved Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
