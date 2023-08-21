<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id'=>1,
                'role_id' => 1,
                'name' => 'Lia',
                'email'=> 'lia@cbn.net.id',
                'gender'=> 'Female',
                'photo_path' => 'a',
                'password' => Hash::make('12345678'),
            ],
            [
                'id' => 2,
                'role_id' => 2,
                'name' => 'Admin',
                'email'=> 'admin@admin.com',
                'gender'=> 'Male',
                'photo_path' => 'a',
                'password' => Hash::make('12345678'),
            ],
        ]);
    }
}
