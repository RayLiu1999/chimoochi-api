<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => '木椅',
        ]);

        Category::create([
            'name' => '塑膠椅',
        ]);

        Category::create([
            'name' => '沙發',
        ]);

        Category::create([
            'name' => '特別推薦',
        ]);

        Category::create([
            'name' => '經典設計',
        ]);

        Category::create([
            'name' => '木椅',
        ]);


    }
}
