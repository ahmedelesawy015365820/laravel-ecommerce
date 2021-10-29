<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\Customer;
use Faker\Factory;
use Illuminate\Database\Seeder;

use function GuzzleHttp\Promise\each;

class CustomerAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $eg   = Country::with('states')->whereId(1)->first();
        $state = $eg->states->random()->id;
        $city = City::whereStateId($state)->inRandomOrder()->first()->id;

        Customer::all()->each(function ($C) use($faker,$state,$city,$eg){

            $C->addresses()->create([
                'address_title'         => 'Home',
                'default_address'       => true,
                'first_name'            => 'Sami',
                'last_name'             => 'Mansour',
                'email'                 => $faker->email,
                'mobile'                => $faker->phoneNumber,
                'address'               => $faker->address,
                'address2'              => $faker->secondaryAddress,
                'country_id'            => $eg->id,
                'state_id'              => $state,
                'city_id'               => $city,
                'zip_code'              => $faker->randomNumber(5),
                'po_box'                => $faker->randomNumber(4),
            ]);

        });

    }
}
