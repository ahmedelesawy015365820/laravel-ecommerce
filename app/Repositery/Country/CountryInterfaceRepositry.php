<?php

namespace App\Repositery\Country;

interface CountryInterfaceRepositry {

    public function index($request);

    public function store($request);

    public function update($request, $country);

    public function destroy($country);

}
