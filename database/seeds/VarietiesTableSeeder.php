<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VarietiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('varieties')->insert([
            'slug' => str_slug('Courgettes'),
            'name' => 'Courgettes',
            'category_id' => 2
        ]);  

        DB::table('varieties')->insert([
            'slug' => str_slug('Tomates'),
            'name' => 'Tomates',
            'category_id' => 1
        ]);   

        DB::table('varieties')->insert([
            'slug' => str_slug('Salades'),
            'name' => 'Salades',
            'category_id' => 2
        ]);

        DB::table('varieties')->insert([
            'slug' => str_slug('Radis'),
            'name' => 'Radis',
            'category_id' => 2
        ]);

        DB::table('varieties')->insert([
            'slug' => str_slug('Pommes'),
            'name' => 'Pommes',
            'category_id' => 1
        ]);  

        DB::table('varieties')->insert([
            'slug' => str_slug('Bananes'),
            'name' => 'Bananes',
            'category_id' => 1
        ]);   

        DB::table('varieties')->insert([
            'slug' => str_slug('Poires'),
            'name' => 'Poires',
            'category_id' => 1
        ]);
        
        DB::table('varieties')->insert([
            'slug' => str_slug('Thym'),
            'name' => 'Thym',
            'category_id' => 3
        ]);  

        DB::table('varieties')->insert([
            'slug' => str_slug('Romarin'),
            'name' => 'Romarin',
            'category_id' => 3
        ]);   

        DB::table('varieties')->insert([
            'slug' => str_slug('Laurier'),
            'name' => 'Laurier',
            'category_id' => 3
        ]);        
    }
}
