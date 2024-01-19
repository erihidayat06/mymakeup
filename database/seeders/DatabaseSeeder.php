<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pilihan;
use App\Models\Category;
use App\Models\Transaksi;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Category::create([
            'nama' => 'Wedding',
            'slug' => 'wedding'
        ]);

        Category::create([
            'nama' => 'Karnaval',
            'slug' => 'karnaval'
        ]);

        Pilihan::factory(10)->create();
        Transaksi::factory(5)->create();
    }
}
