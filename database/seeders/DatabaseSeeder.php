<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name'                         => 'Admin EDL',
            'email'                        => 'admin@edl.bj',
            'password'                     => Hash::make('Admin@2026'),
            'role'                         => 'admin',
        ]);

        // Catégories
        $this->call(CategorySeeder::class);

        // Articles
        $this->call(PostSeeder::class);
    }
}