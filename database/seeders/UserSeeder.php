<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Bintang',
            'email' => 'bintang@gmail.com',
            'password' => hash::make('bintang42'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Dimas',
            'email' => 'dimas@gmial.com',
            'password' => hash::make('dimas42'),
            'role' => 'warga',
            'address' => 'Desa Misal, Jl.Contoh No. 123',
            'phone' => '08123456789',
        ]);
    }
}
