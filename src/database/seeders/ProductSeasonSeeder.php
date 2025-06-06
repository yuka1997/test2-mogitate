<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Season;

class ProductSeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = Product::where('name', 'キウイ')->first();
        $seasons = Season::whereIn('name', ['秋', '冬'])->pluck('id');
        if ($product && $seasons->isNotEmpty()) {
            $product->seasons()->sync($seasons);
        }

        $product = Product::where('name', 'ストロベリー')->first();
        $seasons = Season::whereIn('name', ['春'])->pluck('id');
        if ($product && $seasons->isNotEmpty()) {
            $product->seasons()->sync($seasons);
        }

        $product = Product::where('name', 'オレンジ')->first();
        $seasons = Season::whereIn('name', ['冬'])->pluck('id');
        if ($product && $seasons->isNotEmpty()) {
            $product->seasons()->sync($seasons);
        }

        $product = Product::where('name', 'スイカ')->first();
        $seasons = Season::whereIn('name', ['夏'])->pluck('id');
        if ($product && $seasons->isNotEmpty()) {
            $product->seasons()->sync($seasons);
        }

        $product = Product::where('name', 'ピーチ')->first();
        $seasons = Season::whereIn('name', ['夏'])->pluck('id');
        if ($product && $seasons->isNotEmpty()) {
            $product->seasons()->sync($seasons);
        }

        $product = Product::where('name', 'シャインマスカット')->first();
        $seasons = Season::whereIn('name', ['夏', '秋'])->pluck('id');
        if ($product && $seasons->isNotEmpty()) {
            $product->seasons()->sync($seasons);
        }

        $product = Product::where('name', 'パイナップル')->first();
        $seasons = Season::whereIn('name', ['春', '夏'])->pluck('id');
        if ($product && $seasons->isNotEmpty()) {
            $product->seasons()->sync($seasons);
        }

        $product = Product::where('name', 'ブドウ')->first();
        $seasons = Season::whereIn('name', ['夏', '秋'])->pluck('id');
        if ($product && $seasons->isNotEmpty()) {
            $product->seasons()->sync($seasons);
        }

        $product = Product::where('name', 'バナナ')->first();
        $seasons = Season::whereIn('name', ['夏'])->pluck('id');
        if ($product && $seasons->isNotEmpty()) {
            $product->seasons()->sync($seasons);
        }

        $product = Product::where('name', 'メロン')->first();
        $seasons = Season::whereIn('name', ['春', '夏'])->pluck('id');
        if ($product && $seasons->isNotEmpty()) {
            $product->seasons()->sync($seasons);
        }
    }
}
