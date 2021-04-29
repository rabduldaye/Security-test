<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call([
          
          ConferenceSeeder2::class,
          DivisionSeeder2::class,
          UserSeeder2::class,
          
          GameSeeder2::class,
          
          GamePicks::class,
          
          ConfigSeeder::class,

      ]);
    }
}
