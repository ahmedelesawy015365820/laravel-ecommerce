<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $City[] = ['name' => 'Alexandria' , 'state_id' => 1, 'status' => true];
        $City[] = ['name' => 'Ismailia' , 'state_id' => 2, 'status' => true];
        $City[] = ['name' => 'Aswan' , 'state_id' => 3, 'status' => true];
        $City[] = ['name' => 'Asyut' , 'state_id' => 4, 'status' => true];
        $City[] = ['name' => 'Luxor' , 'state_id' => 5, 'status' => true];
        $City[] = ['name' => 'cairo' , 'state_id' => 6, 'status' => true];
        $City[] = ['name' => 'Bani Sweif' , 'state_id' => 7, 'status' => true];
        $City[] = ['name' => 'Port Said' , 'state_id' => 8, 'status' => true];
        $City[] = ['name' => 'Giza' , 'state_id' => 9, 'status' => true];
        $City[] = ['name' => 'Giza' , 'state_id' => 10, 'status' => true];
        $City[] = ['name' => 'Mansoura' , 'state_id' => 11, 'status' => true];
        $City[] = ['name' => 'Zagazig' , 'state_id' => 12, 'status' => true];

        City::insert($City);
    }
}
