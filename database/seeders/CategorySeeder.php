<?php
namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void {
        $categories = [
            [
                'name'      => 'Solaire',
                'color'     => '#F97316',
                'image_url' => 'https://images.unsplash.com/photo-1509391366360-2e959784a276?w=800&q=80',
            ],
            [
                'name'      => 'PAYG',
                'color'     => '#EAB308',
                'image_url' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800&q=80',
            ],
            [
                'name'      => 'IoT & Smart',
                'color'     => '#10B981',
                'image_url' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&q=80',
            ],
            [
                'name'      => 'Subventions',
                'color'     => '#3B82F6',
                'image_url' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=800&q=80',
            ],
            [
                'name'      => 'Témoignages',
                'color'     => '#8B5CF6',
                'image_url' => 'https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?w=800&q=80',
            ],
            [
                'name'      => 'Innovations',
                'color'     => '#EC4899',
                'image_url' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?w=800&q=80',
            ],
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name'      => $cat['name'],
                'slug'      => Str::slug($cat['name']),
                'color'     => $cat['color'],
                'image_url' => $cat['image_url'],
            ]);
        }
    }
}