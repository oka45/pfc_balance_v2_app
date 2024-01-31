<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => '岡',
            'is_admin' => true,
            'email' => 'oka_test@example.jp',
            'password' => Hash::make('1122')
        ]);
        User::factory(10)->create();
    }
}
