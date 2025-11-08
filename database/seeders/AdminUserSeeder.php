<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => config('app.admin_name'),
            'email' => config('app.admin_email'),
            'password' => Hash::make(config('app.admin_password')),
            'email_verified_at' => now(),
        ]);
    }
}