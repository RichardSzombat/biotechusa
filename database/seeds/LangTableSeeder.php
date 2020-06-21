<?php

use App\Lang;
use Illuminate\Database\Seeder;

class LangTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Lang::create(['name' =>'Magyar','code' => 'hu' ]);
        Lang::create(['name' =>'Angol','code' => 'en' ]);
        Lang::create(['name' =>'Német','code' => 'de' ]);
    }
}
