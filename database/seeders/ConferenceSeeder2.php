<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Conference;

class ConferenceSeeder2 extends Seeder
{
    /**
    * Display a listing of the resource.
    */
    
    

    public function run()
    {

     
      $nfcounter = 1;
      $afcounter = 1;
      
      for ($i = 0; $i < 12; $i++) {

          if ($i < 6) {

              $confName = 'AFC' . $afcounter++;
          } else {
              $confName = 'NFC' . $nfcounter++;
          }
          //create the conference
          Conference::create([
              'name' => $confName,
          ]);

          


      }

    }
  }
  
