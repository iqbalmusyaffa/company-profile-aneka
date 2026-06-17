<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        // Fetch all settings and pluck into a key-value array
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'site_favicon' => 'nullable|image|mimes:png,ico,jpg,jpeg|max:2048',
            'company_profile' => 'nullable|file|mimes:pdf,png,jpg,jpeg|max:5120',
        ]);

        $data = $request->except(['_token', 'site_logo', 'site_favicon', 'company_profile']);

        // Handle File Uploads
        if ($request->hasFile('site_logo')) {
            $path = $request->file('site_logo')->store('settings', 'public');
            Setting::updateOrCreate(['key' => 'site_logo'], ['value' => $path]);
        }

        if ($request->hasFile('site_favicon')) {
            $path = $request->file('site_favicon')->store('settings', 'public');
            Setting::updateOrCreate(['key' => 'site_favicon'], ['value' => $path]);
        }

        if ($request->hasFile('company_profile')) {
            $path = $request->file('company_profile')->store('settings', 'public');
            Setting::updateOrCreate(['key' => 'company_profile'], ['value' => $path]);
        }

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan website berhasil disimpan.');
    }
}
