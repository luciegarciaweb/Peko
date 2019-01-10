<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert([
            'slug' => str_slug('Conditions d\'utilisation'),
            'title' => 'Conditions d\'utilisation',
            'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin felis turpis, mattis ut enim nec, ornare dapibus magna. Mauris a pellentesque neque. Quisque euismod neque justo, eget vestibulum dolor iaculis sed. Aenean eget vehicula ligula, at maximus tellus. Sed ullamcorper non purus non finibus. Phasellus imperdiet leo tortor, placerat consectetur est convallis vel. In pretium, diam laoreet imperdiet tincidunt, eros leo semper purus, et dapibus libero erat vel elit. Pellentesque tincidunt suscipit turpis. Aenean viverra scelerisque porta. Donec iaculis rutrum erat eu laoreet. Fusce ultrices id odio ac convallis. Vivamus sagittis sem sit amet lorem rutrum, a iaculis neque pretium. In bibendum pulvinar scelerisque. Maecenas porta est urna, quis bibendum mi ornare at. Nullam quis ornare ex.</p>',
            'created_at' => Date('Y-m-d H:i:s')
        ]);  

        DB::table('pages')->insert([
            'slug' => str_slug('Mentions légales'),
            'title' => 'Mentions légales',
            'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin felis turpis, mattis ut enim nec, ornare dapibus magna. Mauris a pellentesque neque. Quisque euismod neque justo, eget vestibulum dolor iaculis sed. Aenean eget vehicula ligula, at maximus tellus. Sed ullamcorper non purus non finibus. Phasellus imperdiet leo tortor, placerat consectetur est convallis vel. In pretium, diam laoreet imperdiet tincidunt, eros leo semper purus, et dapibus libero erat vel elit. Pellentesque tincidunt suscipit turpis. Aenean viverra scelerisque porta. Donec iaculis rutrum erat eu laoreet. Fusce ultrices id odio ac convallis. Vivamus sagittis sem sit amet lorem rutrum, a iaculis neque pretium. In bibendum pulvinar scelerisque. Maecenas porta est urna, quis bibendum mi ornare at. Nullam quis ornare ex.</p>',
            'created_at' => Date('Y-m-d H:i:s')
        ]);
    }
}
