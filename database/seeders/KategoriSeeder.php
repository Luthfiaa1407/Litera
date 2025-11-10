<?php

// File: database/seeders/CategorySeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Fiksi',
                'description' => 'Kumpulan cerita yang lahir dari imajinasi dan kreativitas penulis.'
            ],
            [
                'name' => 'Non Fiksi',
                'description' => 'Berisi pengetahuan, fakta, dan pengalaman nyata.'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}