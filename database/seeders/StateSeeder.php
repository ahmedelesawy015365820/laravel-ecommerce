<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{

    public function run()
    {

        $array = ['Alexandria','Ismailia','Aswan','Asyut','Luxor','cairo','Bani Sweif','Port Said',
                    'Giza','Damietta','Dakahlia','Sharkia'
                ];

        foreach($array as $item){
            $state[] = ['name' => $item , 'country_id' => 1, 'status' => true];
        }

        State::insert($state);

    }
}
