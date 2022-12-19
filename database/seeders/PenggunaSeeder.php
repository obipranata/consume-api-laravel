<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pengguna;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pengguna::query()->create(
            [
                    "nama" => "Tegar",
                    "email" => "tegar@gmail.com",
                    "password" => "tegar123"
            ]
        );
    }
}
