<?php

use Illuminate\Database\Seeder;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 1; $i <= 10; $i++)
        {

            DB::table('addresses')->insert([
                'number' => $faker->numberBetween(1,10),
                'street' => $faker->streetName,
                'object_id' => $faker->unique()->numberBetween(1,10),
            ]);
        }
        
    }
}
