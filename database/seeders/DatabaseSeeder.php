<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */



public function run(): void
{
    User::firstOrCreate(
        ['email' => 'admin@example.com'], // يبحث عن هذا الإيميل أولاً
        [
            'name' => 'Admin',
            'password' => Hash::make('12345678'), // كلمة المرور الجديدة
        ]
    );
}
    }

