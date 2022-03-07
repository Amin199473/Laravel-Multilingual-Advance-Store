<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Session;

class LanguageController extends Controller
{

    public function Persian()
    {
        session()->get('language');
        session()->forget('language');
        Session::put('language', 'persian');
        return redirect()->back();
    }

    public function English()
    {
        session()->get('language');
        session()->forget('language');
        Session::put('language', 'english');
        return redirect()->back();
    }
}
