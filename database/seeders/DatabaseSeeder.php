<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Mimin',
            'email' => 'mimin@gmail.com',
            'password' => hash::make('mimin42'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Gilang saputra',
            'email' => 'gilang@gmial.com',
            'password' => hash::make('gilang42'),
            'role' => 'warga',
            'address' => 'Desa Wonosai, Jl.Lengkong No. 12',
            'phone' => '081903771234',
        ]);
    }
}
