<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Conference;

class ConferenceSeeder extends Seeder
{
    /**
    * Display a listing of the resource.
    */
    
    

    public function run()
    {

        Conference::create([
            'name' => 'NFC',
        ]);
        Conference::create([
            'name' => 'AFC',
        ]);
      
          


      

    }
  }
  
