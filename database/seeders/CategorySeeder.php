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
        // Main Categories
        $categories = [
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
        ];

        DB::table('categories')->insert($categories);

        // Get parent category IDs
        $electronicsId = DB::table('categories')->where('name', 'إلكترونيات')->first()->id;
        $clothesId = DB::table('categories')->where('name', 'ملابس')->first()->id;
        $shoesId = DB::table('categories')->where('name', 'أحذية')->first()->id;

        // Subcategories
        $subcategories = [
            [
                'name' => 'هواتف',
                'parent_id' => $electronicsId,
                'image' => 'assets/img/sub-categories/phones.jpg',
                'description' => 'أحدث الهواتف الذكية.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'كمبيوترات',
                'parent_id' => $electronicsId,
                'image' => 'assets/img/sub-categories/computers.jpg',
                'description' => 'أجهزة الكمبيوتر المحمولة والمكتبية.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'رجالي',
                'parent_id' => $clothesId,
                'image' => 'assets/img/sub-categories/mens-clothing.jpg',
                'description' => 'ملابس رجالية عصرية.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'حريمي',
                'parent_id' => $clothesId,
                'image' => 'assets/img/sub-categories/womens-clothing.jpg',
                'description' => 'ملابس نسائية أنيقة.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'رياضية',
                'parent_id' => $shoesId,
                'image' => 'assets/img/sub-categories/sport-shoes.jpg',
                'description' => 'أحذية رياضية مريحة.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'غسالات',
                'parent_id' => $electronicsId,
                'image' => 'assets/img/sub-categories/washing-machines.jpg',
                'description' => 'أحدث غسالات الملابس.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('categories')->insert($subcategories);
    }
}
