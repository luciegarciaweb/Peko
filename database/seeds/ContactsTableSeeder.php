<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            DB::table('contacts')->insert([
                'fullname' => "Contact ".$i,
                'object' => 'sujet',
                'message' => "lorem lorem lorem",
                'email' => 'email'.$i.'@email.fr',
                'is_read' => mt_rand(0,1),
                'created_at' => Date('Y-m-d H:i:s')
            ]);            
        }
    }
}
