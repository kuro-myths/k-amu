<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function index(): View
    {
        $settings = SystemSetting::all()->keyBy('key');
        return view('superadmin.pengaturan.index', ['settings' => $settings]);
    }

    public function update(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'app_name' => 'nullable|string|max:255',
            'app_description' => 'nullable|string',
            'support_email' => 'nullable|email',
            'support_phone' => 'nullable|string',
            'timezone' => 'nullable|string',
            'mail_driver' => 'nullable|string',
            'mail_from' => 'nullable|email',
            'smtp_host' => 'nullable|string',
            'smtp_port' => 'nullable|integer',
            'smtp_username' => 'nullable|string',
        ]);

        foreach ($validated as $key => $value) {
            if ($value !== null) {
                SystemSetting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }
        }

        return back()->with('success', 'Pengaturan berhasil diperbarui');
    }

    public function clearCache(): \Illuminate\Http\RedirectResponse
    {
        \Illuminate\Support\Facades\Cache::flush();
        return back()->with('success', 'Cache berhasil dihapus');
    }

    public function sistem(): View
    {
        $settings = SystemSetting::all()->keyBy('key');
        return view('superadmin.pengaturan.sistem', ['settings' => $settings]);
    }

    public function updateSistem(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'app_name' => 'required|string|max:255',
            'app_description' => 'nullable|string',
            'maintenance_mode' => 'nullable|boolean',
        ]);

        foreach ($validated as $key => $value) {
            SystemSetting::set($key, $value);
        }

        return back()->with('success', 'Pengaturan sistem berhasil diperbarui');
    }

    public function notifikasi(): View
    {
        $settings = SystemSetting::all()->keyBy('key');
        return view('superadmin.pengaturan.notifikasi', ['settings' => $settings]);
    }

    public function tampilan(): View
    {
        $settings = SystemSetting::all()->keyBy('key');
        return view('superadmin.pengaturan.tampilan', ['settings' => $settings]);
    }
}
