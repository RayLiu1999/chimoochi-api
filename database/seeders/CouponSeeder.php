<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupon::create([
            'name' => '歡慶開幕',
            'code' => 'CHIMOOCHIOPEN',
            'discount_present' => 80,
            'expired_at' => date("Y-m-d H:i:s", 1645545599),
            'is_enabled' => true,
        ]);
    }
}
