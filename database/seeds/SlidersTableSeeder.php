<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SlidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sliders')->insert([
            'picture' => 'sliders/slider1.jpeg',
            'title' => 'Salade composée',
            'created_at' => Date('Y-m-d H:i:s')
        ]);

        DB::table('sliders')->insert([
            'picture' => 'sliders/slider2.jpg',
            'title' => 'Semis de betteraves',
            'created_at' => Date('Y-m-d H:i:s')
        ]);        
    }
}
