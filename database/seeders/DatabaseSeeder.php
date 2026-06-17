<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat Akun Admin Utama
        User::updateOrCreate(
            ['email' => 'admin@anekajaya.com'], // Pastikan email unik
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password'), // Anda bisa mengganti ini nanti
                'email_verified_at' => now(),
            ]
        );
    }
}
