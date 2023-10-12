<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        (new User([
            'email' => 'foo@bar.com',
            'password' => Hash::createBcryptDriver()->make('password'),
        ]))->save();
    }
}
