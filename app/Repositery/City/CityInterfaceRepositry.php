<?php

namespace App\Repositery\City;

interface CityInterfaceRepositry {

    public function index($request);

    public function store($request);

    public function update($request, $city);

    public function destroy($city);

}
