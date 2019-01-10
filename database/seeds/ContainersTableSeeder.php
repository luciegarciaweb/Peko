<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContainersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('containers')->insert([
            'name' => 'barquette',
        ]); 

        DB::table('containers')->insert([   
            'name' => 'bouquet',
        ]); 

        DB::table('containers')->insert([
            'name' => 'lot',
        ]); 

        DB::table('containers')->insert([
            'name' => 'cagette',
        ]); 

        DB::table('containers')->insert([
            'name' => 'plant',
        ]); 

        DB::table('containers')->insert([
            'name' => 'sachet',
        ]); 

        DB::table('containers')->insert([
            'name' => 'sac',
        ]); 

        DB::table('containers')->insert([
            'name' => 'pot',
        ]);

        DB::table('containers')->insert([
            'name' => 'botte',
        ]);        
        
        DB::table('containers')->insert([
            'name' => 'vrac'
        ]);
    }
}
