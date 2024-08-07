<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TariffRangeSeeder extends Seeder
{
    public function run()
    {
        $tariffId = DB::table('tariffs')->where('name', 'LT-1A')->first()->id;

        DB::table('tariff_ranges')->insert([
            ['tariff_id' => $tariffId, 'start_units' => 0, 'end_units' => 50, 'rate' => 2.80],
            ['tariff_id' => $tariffId, 'start_units' => 51, 'end_units' => 100, 'rate' => 3.20],
            ['tariff_id' => $tariffId, 'start_units' => 101, 'end_units' => 150, 'rate' => 4.20],
            ['tariff_id' => $tariffId, 'start_units' => 151, 'end_units' => 200, 'rate' => 5.80],
            ['tariff_id' => $tariffId, 'start_units' => 201, 'end_units' => null, 'rate' => 7.00],
        ]);
    }
}
