<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\ShippingCompany;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $sh01 = ShippingCompany::create([
            'name'      => 'Aramex Inside',
            'code'      => 'ARA',
            'description' => '8 - 10 days',
            'fast'      => false,
            'cost'      => '15.00',
            'status'    => true,
        ]);
        $sh01->country()->attach([1]);


        $sh02 = ShippingCompany::create([
            'name'      => 'Aramex Inside Speed shipping',
            'code'      => 'ARA-SPD',
            'description' => '1 - 3 days',
            'fast'      => true,
            'cost'      => '25.00',
            'status'    => true,
        ]);
        $sh02->country()->attach([1]);

        $countriesIds = Country::where('id', '!=', 1)->pluck('id')->toArray();

        $sh03 = ShippingCompany::create([
            'name'      => 'Aramex Outside',
            'code'      => 'ARA-O',
            'description' => '15 - 20 days',
            'fast'      => false,
            'cost'      => '50.00',
            'status'    => true,
        ]);
        $sh03->country()->attach($countriesIds);

        $sh04 = ShippingCompany::create([
            'name'      => 'Aramex Outside Speed shipping',
            'code'      => 'ARA-O-SPD',
            'description' => '5 - 10 days',
            'fast'      => true,
            'cost'      => '80.00',
            'status'    => true,
        ]);
        $sh04->country()->attach($countriesIds);

    }
}
