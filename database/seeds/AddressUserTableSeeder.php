<?php

use Illuminate\Database\Seeder;

class AddressUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Address_user::class, 8)->create();
    }
}
