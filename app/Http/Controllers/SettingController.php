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

    public function updateShopProfile(Request $request)
    {
        $data = $request->except(['_token', '_method']);
        
        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return back()->with('success', 'Profil toko berhasil diperbarui.');
    }

    public function index()
    {
        return view('settings.index');
    }
}
