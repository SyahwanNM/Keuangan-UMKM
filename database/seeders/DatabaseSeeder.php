<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('✅ Database seeder selesai - tidak ada akun demo yang dibuat');
        $this->command->info('📝 Silakan daftar akun baru melalui halaman registrasi');
    }

}
