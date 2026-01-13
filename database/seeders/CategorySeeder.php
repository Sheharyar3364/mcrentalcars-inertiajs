<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => [
                    'en' => 'Economy',
                    'ar' => 'اقتصادي',
                    'fr' => 'Économique'
                ],
                'slug' => 'economy',
                'description' => [
                    'en' => 'Affordable and fuel-efficient vehicles perfect for city driving',
                    'ar' => 'سيارات اقتصادية وموفرة للوقود مثالية للقيادة في المدينة',
                    'fr' => 'Véhicules abordables et économes en carburant parfaits pour la conduite en ville'
                ],
                'icon' => 'car',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Compact',
                    'ar' => 'صغيرة الحجم',
                    'fr' => 'Compacte'
                ],
                'slug' => 'compact',
                'description' => [
                    'en' => 'Small yet spacious cars ideal for urban adventures',
                    'ar' => 'سيارات صغيرة لكنها واسعة ومثالية للمغامرات الحضرية',
                    'fr' => 'Petites voitures spacieuses idéales pour les aventures urbaines'
                ],
                'icon' => 'car-side',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'SUV',
                    'ar' => 'دفع رباعي',
                    'fr' => 'SUV'
                ],
                'slug' => 'suv',
                'description' => [
                    'en' => 'Spacious sport utility vehicles for family trips and adventures',
                    'ar' => 'سيارات رياضية متعددة الاستخدامات واسعة للرحلات العائلية والمغامرات',
                    'fr' => 'Véhicules utilitaires sport spacieux pour voyages en famille et aventures'
                ],
                'icon' => 'truck',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Luxury',
                    'ar' => 'فاخرة',
                    'fr' => 'Luxe'
                ],
                'slug' => 'luxury',
                'description' => [
                    'en' => 'Premium vehicles with advanced features and exceptional comfort',
                    'ar' => 'سيارات فاخرة بمميزات متقدمة وراحة استثنائية',
                    'fr' => 'Véhicules haut de gamme avec fonctionnalités avancées et confort exceptionnel'
                ],
                'icon' => 'sparkles',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Sports',
                    'ar' => 'رياضية',
                    'fr' => 'Sport'
                ],
                'slug' => 'sports',
                'description' => [
                    'en' => 'High-performance sports cars for an exhilarating driving experience',
                    'ar' => 'سيارات رياضية عالية الأداء لتجربة قيادة مثيرة',
                    'fr' => 'Voitures de sport haute performance pour une expérience de conduite exaltante'
                ],
                'icon' => 'zap',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Electric',
                    'ar' => 'كهربائية',
                    'fr' => 'Électrique'
                ],
                'slug' => 'electric',
                'description' => [
                    'en' => 'Eco-friendly electric vehicles with zero emissions',
                    'ar' => 'سيارات كهربائية صديقة للبيئة بدون انبعاثات',
                    'fr' => 'Véhicules électriques écologiques sans émissions'
                ],
                'icon' => 'bolt',
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Van',
                    'ar' => 'حافلة صغيرة',
                    'fr' => 'Van'
                ],
                'slug' => 'van',
                'description' => [
                    'en' => 'Large vans perfect for group travel and cargo transport',
                    'ar' => 'حافلات كبيرة مثالية للسفر الجماعي ونقل البضائع',
                    'fr' => 'Grands vans parfaits pour voyages en groupe et transport de marchandises'
                ],
                'icon' => 'bus',
                'sort_order' => 7,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }

        $this->command->info('✅ Categories seeded successfully!');
    }
}
