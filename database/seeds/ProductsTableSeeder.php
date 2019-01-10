<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'variety_id' => 5,
            'container_id' => 6,
            'slug' => str_slug('Golden Delicious'),
            'title' => 'Golden Delicious',
            'price' => 2.50,
            'price_kilo' => 2.50,
            'weight_unity' => 1000,
            'quantity' => 50,
            'body' => 'Golden Delicious est le nom d\'un cultivar de pommier domestique. Cette variété est depuis plus d\'un siècle une des cinq variétés les plus utilisées par les obtenteurs pour créer de nouvelles variétés.',
            'is_active' => true,
            'push_forward' => true,
            'picture' => 'products/golden.jpeg',
            'created_at' => Date('Y-m-d H:i:s')
        ]);
    }
}
