<?php

namespace Database\Seeders;

use App\Models\SystemUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = SystemUser::where("email","imarani@gmail.com")->first();
        if(!$admin){
            SystemUser::create([
            'firstname' => 'Imrani',
            'middlename' => 'Balari',
            'lastname' => 'Omar',
            'email' => 'imarani@gmail.com',
            'mobile' => '0756781234',
            'gender' => 'Male',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);
        }
    }
}
