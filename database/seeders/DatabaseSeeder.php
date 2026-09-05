<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Faiz At Thoriq',
            'username' => 'sagara',
            'email' => 'faizatthoriq09@gmail.com',
            'password' => Hash::make('sagara290509'),
            'no_whatsapp' => '085950314932',
            'role' => 'admin',
        ]);
    }
}