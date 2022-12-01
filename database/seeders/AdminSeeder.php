<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
                'name' => 'Rajindra Sankalpa',
                'email' => 'rajindrasankalpa90@gmail.com',
                'password' => Hash::make('12341234'),
                'is_admin' => '1',
                'status' => '1',
        ]);
        DB::table('users')->insert([
                'name' => 'Admin',
                'email' => 'admin@trnlk.com',
                'password' => Hash::make('admin@123'),
                'is_admin' => '1',
                'status' => '1',
        ]);
    }
}
