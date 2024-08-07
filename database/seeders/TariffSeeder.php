<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TariffSeeder extends Seeder
{
    public function run()
    {
        DB::table('tariffs')->insert([
            [
                'name' => 'LT-1A',
                'fixed_charge' => 35.00,
                'flat_rate' => 5.00,
                'telescopic' => true
            ]
        ]);
    }
}
