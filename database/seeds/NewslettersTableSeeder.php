<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewslettersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 20; $i++) {
            DB::table('newsletters')->insert([
                'email' => "client".$i."@client.com",
                'created_at' => Date('Y-m-d H:i:s')
            ]);            
        }
    }
}
