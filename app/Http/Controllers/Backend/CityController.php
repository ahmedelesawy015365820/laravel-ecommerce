<?php

namespace App\Http\Controllers\Backend;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Repositery\City\CityInterfaceRepositry;

class CityController extends Controller
{
    protected $city;


    function __construct(CityInterfaceRepositry $city){

        $this->city = $city;

        $this->middleware('permission:city-list', ['only' => ['index']]);
        $this->middleware('permission:city-create', ['only' => ['create','store']]);
        $this->middleware('permission:city-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:city-delete', ['only' => ['destroy']]);

    }
    public function index(Request $request)
    {
        return $this->city->index($request);
    }


    public function store(CityRequest $request)
    {
        return $this->city->store($request);
    }

    public function update(CityRequest $request, City $city)
    {
        return $this->city->update($request,$city);
    }

    public function destroy(City $city)
    {
        return $this->city->destroy($city);
    }
}
