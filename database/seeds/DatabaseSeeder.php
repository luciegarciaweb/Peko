<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            CategoriesTableSeeder::class,
            VarietiesTableSeeder::class,
            ContainersTableSeeder::class,
            ProductsTableSeeder::class,
            //NewslettersTableSeeder::class,
            SlidersTableSeeder::class,
            PagesTableSeeder::class,
            //ContactsTableSeeder::class
        ]);
    }
}
