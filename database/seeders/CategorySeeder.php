<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'إلكترونيات',
                'image' => 'assets/img/modern-stationary-collection-arrangement.jpg',
                'description' => 'أحدث الأجهزة الإلكترونية مثل الهواتف والكمبيوترات.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ملابس',
                'image' => 'assets/img/fast-fashion-vs-slow-sustainable-fashion.jpg',
                'description' => 'ملابس رجالي، حريمي، وأطفال بأحدث الموديلات.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'أحذية',
                'image' => 'assets/img/man-choosing-foot-wear-mens-store.jpg',
                'description' => 'أحذية رياضية ورسمية لكل الأذواق.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'أثاث',
                'image' => 'assets/img/living-room-scandinavian-interior-design.jpg',
                'description' => 'أثاث منزلي ومكتبي عالي الجودة.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'أجهزة منزلية',
                'image' => 'assets/img/Home appliances.jpg',
                'description' => 'أدوات كهربائية ومنزلية أساسية.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
