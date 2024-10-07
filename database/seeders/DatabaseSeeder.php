<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\Petugas;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Admin::create([
            'nama_admin' => 'Andi',
            'username' => 'hanya_admin',
            'password' => bcrypt('admin123456'),
        ]);

        Petugas::create([
            'nama_petugas' => 'Mas Yuka',
            'alamat_petugas' => '<div>Testing</div>',
            'username' => 'hanya_petugas',
            'password' => bcrypt('petugas1234'),
        ]);
    }
}
