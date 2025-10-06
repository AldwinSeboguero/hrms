<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Aldwin Seboguero',
            'email' => 'sebogueroaldwin@gmail.com',
            'email_verified_at'=> now(),
            'password' => Hash::make('ICTMOPa55'),
            'remember_token' => Str::random(10),
        ])->assignRole('admin');
    }
}
