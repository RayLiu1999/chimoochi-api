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
            'id' => 1,
            'name' => '木椅',
        ]);

        Category::create([
            'id' => 2,
            'name' => '塑膠椅',
        ]);

        Category::create([
            'id' => 3,
            'name' => '沙發',
        ]);

        Category::create([
            'id' => 4,
            'name' => '金屬椅',
        ]);

        Category::create([
            'id' => 5,
            'name' => '經典設計',
        ]);

        Category::create([
            'id' => 6,
            'name' => '特別推薦',
        ]);
    }
}
