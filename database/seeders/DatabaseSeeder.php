<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'مدير النظام',
            'email' => 'admin@tabahar.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'مدير الجمعية',
            'email' => 'manager@tabahar.com',
            'password' => Hash::make('manager123'),
            'role' => 'manager',
        ]);

        User::create([
            'name' => 'الباحث الاجتماعي',
            'email' => 'user@tabahar.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'مدخل البيانات',
            'email' => 'entry@tabahar.com',
            'password' => Hash::make('entry123'),
            'role' => 'user',
        ]);
    }
}
