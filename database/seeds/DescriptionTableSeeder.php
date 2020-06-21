<?php

use App\Description;
use App\Lang;
use Illuminate\Database\Seeder;

class DescriptionTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Description::create(['text' =>'Megnöveli a használó motivációját 5-tel.','lang_id' => '1' ]);
        Description::create(['text' =>'Increases the users motivation by 5.','lang_id' => '2' ]);
        Description::create(['text' =>'','lang_id' => '3' ]);
    }
}
