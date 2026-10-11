<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class usersseeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Petugas',
            'email' => 'petugas@gmail.com',
            'password' => Hash::make('PTGS_MantapRispakWuow'),
            'role' => 'petugas',
        ]);
    }
}