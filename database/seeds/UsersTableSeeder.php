<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() 
    {
        DB::table('users')->insert([
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'firstname' => 'Jean-Michel',
            'lastname' => 'Vial',
            'created_at' => Date('Y-m-d H:i:s'),
            'is_admin' => true
        ]);

        for ($i = 1; $i <= 10; $i++) {
            DB::table('users')->insert([
                'email' => 'client' .$i . '@client.com',
                'password' => bcrypt('client'),
                'firstname' => 'John',
                'lastname' => 'Doe',
                'created_at' => Date('Y-m-d H:i:s')
            ]);
        }
    }
}
