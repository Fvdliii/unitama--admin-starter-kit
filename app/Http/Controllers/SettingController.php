<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('setting.index',[
            'title' => 'Setting',
            'setting' => Setting::first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
    $validated = $request->validate([
    'app_name'    => 'required|string|max:255',
    'copyright'   => 'required|string|max:255',
    'login_title' => 'required|string|max:255',
    'keywords'    => 'nullable|string|max:255',
    'description' => 'nullable|string',
    'logo'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
], [
    'app_name.required'    => 'Nama aplikasi wajib diisi.',
    'copyright.required'   => 'Hak cipta (copyright) wajib diisi.',
    'login_title.required' => 'Judul halaman login wajib diisi.',
    
    'logo.image'           => 'Logo harus berupa gambar.',
    'logo.mimes'           => 'Format gambar logo harus jpeg, png, atau jpg.',
    'logo.max'             => 'Ukuran gambar logo maksimal :max KB (2MB).',
]);

        DB::beginTransaction();
            try {

            if($request->file('logo')) {
                $validated['logo'] = $request->file('logo')->store('logo', 'public');
                if($setting->logo) {
                    Storage::disk('public')->delete($setting->logo);
                }
            }

                
                $setting->update($validated);
                DB::commit();
                return to_route('setting.index')->withSuccess('Data Berhasil Di Simpan');


            } catch(\Exception $e) {
                DB::rollBack();
                return to_route('setting.index')->withError('Data Gagal Di Simpan');
            }
    }
}
