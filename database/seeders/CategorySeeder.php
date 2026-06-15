<?php
namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder {
    public function run(): void {
       $categories = [
           ['name' => 'Solaire',      'color' => '#F97316'],
           ['name' => 'PAYG',         'color' => '#EAB308'],
           ['name' => 'IoT & Smart',  'color' => '#10B981'],
           ['name' => 'Subventions',  'color' => '#3B82F6'],
           ['name' => 'Témoignages',  'color' => '#8B5CF6'],
           ['name' => 'Innovations',  'color' => '#EC4899'],
        ];
        foreach ($categories as $cat) {
           Category::create([
               'name'  => $cat['name'],
               'slug'  => Str::slug($cat['name']),
               'color' => $cat['color'],
           ]);
        }
    }
}