<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'app_name' => 'Admin Laravel',
            'copyright' => 'Admin Laravel || 2026',
            'login_title' => 'Admin Laravel',
            'keywords' => 'root admin, dashboard laravel, admin panel, manajemen user, sistem autentikasi, superadmin laravel, aplikasi back-office, manajemen sistem, enterprise dashboard, laravel 11, sistem manajemen role',
            'description' => 'Panel Admin Utama (Root Admin) berbasis Laravel yang aman dan efisien. Dilengkapi dengan manajemen pengguna, kontrol akses berbasis peran (RBAC), monitoring sistem, dan konfigurasi aplikasi terpusat.',
        ]);
    }
}
