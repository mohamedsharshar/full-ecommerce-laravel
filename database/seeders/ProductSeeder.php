<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product; // استدعاء الموديل

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => [
                'en' => 'iPhone 15',
                'ar' => 'آيفون 15',
            ],
            'category_id' => 1, // إلكترونيات
            'description' => [
                'en' => 'Latest Apple iPhone with A16 chip.',
                'ar' => 'أحدث آيفون من آبل بمعالج A16.',
            ],
            'price' => 999.99,
            'quantity' => 50,
            'image' => 'https://cdsassets.apple.com/live/7WUAS350/images/tech-specs/iphone_15_hero.png',
        ]);

        Product::create([
            'name' => [
                'en' => 'Samsung Galaxy S23',
                'ar' => 'سامسونج جالاكسي S23',
            ],
            'category_id' => 1, // إلكترونيات
            'description' => [
                'en' => 'Flagship Samsung phone with Snapdragon processor.',
                'ar' => 'هاتف سامسونج الرائد بمعالج سناب دراجون.',
            ],
            'price' => 899.99,
            'quantity' => 40,
            'image' => 'https://images.samsung.com/sa_en/smartphones/galaxy-s23/buy/kv_group_MO_v2.jpg',
        ]);

        Product::create([
            'name' => [
                'en' => 'Sony WH-1000XM5 Headphones',
                'ar' => 'سوني WH-1000XM5 سماعات',
            ],
            'category_id' => 2, // ممكن تخليها سماعات/إكسسوارات
            'description' => [
                'en' => 'Noise-cancelling wireless headphones.',
                'ar' => 'سماعات لاسلكية بخاصية إلغاء الضوضاء.',
            ],
            'price' => 349.99,
            'quantity' => 25,
            'image' => 'https://images-eu.ssl-images-amazon.com/images/I/51hrEIBMDzL._AC_UL210_SR210,210_.jpg',
        ]);

        Product::create([
            'name' => [
                'en' => 'MacBook Pro 14"',
                'ar' => 'ماك بوك برو 14"',
            ],
            'category_id' => 3, // كمبيوترات
            'description' => [
                'en' => 'Apple MacBook Pro with M2 chip.',
                'ar' => 'ماك بوك برو من آبل بمعالج M2.',
            ],
            'price' => 1999.00,
            'quantity' => 15,
            'image' => 'https://cdsassets.apple.com/live/SZLF0YNV/images/sp/111902_mbp14-silver2.png',
        ]);
    }
}
