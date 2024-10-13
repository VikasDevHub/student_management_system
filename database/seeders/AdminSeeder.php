<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert data using the DB facade
         DB::table('users')->insert([
             'name' => 'admin',
             'email' => 'admin@gmail.com',
             'email_verified_at' => now(),
             'password' => Hash::make('12345678'),
             'created_at' => now(),
             'updated_at' => now(),
         ]);
    }
}
