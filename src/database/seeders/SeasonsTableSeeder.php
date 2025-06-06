<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Season;

class SeasonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Season::insert([
            ['name' => '春', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '夏', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '秋', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '冬', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
