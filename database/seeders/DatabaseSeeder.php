<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
            Menu::create([
                'nama' => 'Kopi Cappucinno',
                'kategori' => 'Minuman',
                'harga'    => '7000',
                'gambar'   => 'asset/img/cappucino.jpg'
            ]);
            Menu::create([
                'nama' => 'Kopi Latte',
                'kategori' => 'Minuman',
                'harga'    => '7000',
                'gambar'   => 'asset/img/latte.jpg'
            ]);
            Menu::create([
                'nama' => 'Es Teh',
                'kategori' => 'Minuman',
                'harga'    => '3000',
                'gambar'   => 'asset/img/esteh.jpg'
            ]);

    }
}
