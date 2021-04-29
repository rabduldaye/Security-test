<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('map')->insert([
            'name' => 'Millenium Park',
            'address' => '201 E Randolph St',
            'city' => 'Chicago',
            'state' => 'IL',
            'hours' => '6:00am-11:00pm',
            'latitude' => 41.8825524,
            'longitude' => -87.6225514,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
