<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;


class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $country []=['name'=>  'Egypt', 'status' => true] ;
        $country []=['name'=>  'Emirates', 'status' => true] ;
        $country []=['name'=>  'Sadui', 'status' => true] ;

        Country::insert($country);

    }
}
