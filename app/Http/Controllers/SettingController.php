<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function shopProfile()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('settings.shop-profile', compact('settings'));
    }

    public function index()
    {
        return view('settings.index');
    }
}
