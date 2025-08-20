<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'iPhone 15',
                'category_id' => 1,
                'description' => 'Latest Apple iPhone with A16 chip.',
                'price' => 999.99,
                'quantity' => 50,
                'image' => 'https://cdsassets.apple.com/live/7WUAS350/images/tech-specs/iphone_15_hero.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Samsung Galaxy S23',
                'category_id' => 1,
                'description' => 'Flagship Samsung phone with Snapdragon processor.',
                'price' => 899.99,
                'quantity' => 40,
                'image' => 'https://images.samsung.com/sa_en/smartphones/galaxy-s23/buy/kv_group_MO_v2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sony WH-1000XM5 Headphones',
                'category_id' => 2,
                'description' => 'Noise-cancelling wireless headphones.',
                'price' => 349.99,
                'quantity' => 25,
                'image' => 'https://images-eu.ssl-images-amazon.com/images/I/51hrEIBMDzL._AC_UL210_SR210,210_.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'MacBook Pro 14"',
                'category_id' => 3,
                'description' => 'Apple MacBook Pro with M2 chip.',
                'price' => 1999.00,
                'quantity' => 15,
                'image' => 'https://cdsassets.apple.com/live/SZLF0YNV/images/sp/111902_mbp14-silver2.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);


    }
}
