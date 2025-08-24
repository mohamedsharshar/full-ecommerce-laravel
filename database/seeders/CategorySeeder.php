<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category; // مهم نستخدم الموديل

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Main Categories
        $electronics = Category::create([
            'name' => [
                'ar' => 'إلكترونيات',
                'en' => 'Electronics',
            ],
            'image' => 'assets/img/modern-stationary-collection-arrangement.jpg',
            'description' => [
                'ar' => 'أحدث الأجهزة الإلكترونية مثل الهواتف والكمبيوترات.',
                'en' => 'Latest electronic devices such as phones and computers.',
            ],
        ]);

        $clothes = Category::create([
            'name' => [
                'ar' => 'ملابس',
                'en' => 'Clothes',
            ],
            'image' => 'assets/img/fast-fashion-vs-slow-sustainable-fashion.jpg',
            'description' => [
                'ar' => 'ملابس رجالي، حريمي، وأطفال بأحدث الموديلات.',
                'en' => 'Men, women and kids clothing with the latest styles.',
            ],
        ]);

        $shoes = Category::create([
            'name' => [
                'ar' => 'أحذية',
                'en' => 'Shoes',
            ],
            'image' => 'assets/img/man-choosing-foot-wear-mens-store.jpg',
            'description' => [
                'ar' => 'أحذية رياضية ورسمية لكل الأذواق.',
                'en' => 'Sports and formal shoes for every taste.',
            ],
        ]);

        $furniture = Category::create([
            'name' => [
                'ar' => 'أثاث',
                'en' => 'Furniture',
            ],
            'image' => 'assets/img/living-room-scandinavian-interior-design.jpg',
            'description' => [
                'ar' => 'أثاث منزلي ومكتبي عالي الجودة.',
                'en' => 'High quality home and office furniture.',
            ],
        ]);

        $appliances = Category::create([
            'name' => [
                'ar' => 'أجهزة منزلية',
                'en' => 'Home Appliances',
            ],
            'image' => 'assets/img/Home appliances.jpg',
            'description' => [
                'ar' => 'أدوات كهربائية ومنزلية أساسية.',
                'en' => 'Essential electrical and home appliances.',
            ],
        ]);

        // Subcategories
        Category::create([
            'name' => [
                'ar' => 'هواتف',
                'en' => 'Phones',
            ],
            'parent_id' => $electronics->id,
            'image' => 'assets/img/sub-categories/phones.jpg',
            'description' => [
                'ar' => 'أحدث الهواتف الذكية.',
                'en' => 'Latest smartphones.',
            ],
        ]);

        Category::create([
            'name' => [
                'ar' => 'كمبيوترات',
                'en' => 'Computers',
            ],
            'parent_id' => $electronics->id,
            'image' => 'assets/img/sub-categories/computers.jpg',
            'description' => [
                'ar' => 'أجهزة الكمبيوتر المحمولة والمكتبية.',
                'en' => 'Laptops and desktop computers.',
            ],
        ]);

        Category::create([
            'name' => [
                'ar' => 'رجالي',
                'en' => 'Men',
            ],
            'parent_id' => $clothes->id,
            'image' => 'assets/img/sub-categories/mens-clothing.jpg',
            'description' => [
                'ar' => 'ملابس رجالية عصرية.',
                'en' => 'Trendy men’s clothing.',
            ],
        ]);

        Category::create([
            'name' => [
                'ar' => 'حريمي',
                'en' => 'Women',
            ],
            'parent_id' => $clothes->id,
            'image' => 'assets/img/sub-categories/womens-clothing.jpg',
            'description' => [
                'ar' => 'ملابس نسائية أنيقة.',
                'en' => 'Elegant women’s clothing.',
            ],
        ]);

        Category::create([
            'name' => [
                'ar' => 'رياضية',
                'en' => 'Sports',
            ],
            'parent_id' => $shoes->id,
            'image' => 'assets/img/sub-categories/sport-shoes.jpg',
            'description' => [
                'ar' => 'أحذية رياضية مريحة.',
                'en' => 'Comfortable sports shoes.',
            ],
        ]);

        Category::create([
            'name' => [
                'ar' => 'غسالات',
                'en' => 'Washing Machines',
            ],
            'parent_id' => $appliances->id,
            'image' => 'assets/img/sub-categories/washing-machines.jpg',
            'description' => [
                'ar' => 'أحدث غسالات الملابس.',
                'en' => 'Latest washing machines.',
            ],
        ]);
    }
}
