<?php

use Illuminate\Database\Seeder;

class ColorProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Color_product::class, 40)->create();
    }
}
