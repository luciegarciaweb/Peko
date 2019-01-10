<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'id' => 1,
            'slug' => str_slug('Fruits'),
            'name' => 'Fruits'
        ]);

        DB::table('categories')->insert([
            'id' => 2,
            'slug' => str_slug('Légumes'),
            'name' => 'Légumes'
        ]);   

        DB::table('categories')->insert([
            'id' => 3,
            'slug' => str_slug('Aromates'),
            'name' => 'Aromates'
        ]);
    }
}
