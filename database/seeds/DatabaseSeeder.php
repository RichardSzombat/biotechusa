<?php

use App\Tags;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call('TagsTableSeeder');
        $this->call('LangTableSeeder');
        $this->call('ProductTableSeeder');
        $this->call('DescriptionTableSeeder');
        $this->call('ProductDescriptionTableSeeder');

        $this->call('ProductTagsTableSeeder');


    }
}
