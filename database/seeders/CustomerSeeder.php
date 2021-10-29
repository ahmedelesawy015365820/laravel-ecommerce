<?php

namespace Database\Seeders;

use App\Models\Customer;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();


        for ($i = 1; $i <= 500; $i++) {
            $customers[] = [
                'first_name'                  => $faker->firstName,
                'last_name'                  => $faker->lastName,
                'username'           => $faker->unique()->userName,
                'email'                 => $faker->unique()->safeEmail,
                'mobile'              => '3763'. $faker->numberBetween(9000, 1000000),
                'password'              => bcrypt('12345678'),
                'customer_image'                => null,
                'status'                =>  1,
                'remember_token'         => Str::random(10),
                'created_at'            => now(),
                'updated_at'            => now(),
            ];
        }

        $chunks = array_chunk($customers, 100);
        foreach ($chunks as $chunk) {
            Customer::insert($chunk);
        }
    }
}
