<?php

namespace App\Http\Controllers\Backend;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;
use App\Repositery\Country\CountryInterfaceRepositry;

class CountryController extends Controller
{

    protected $Category;


    function __construct(CountryInterfaceRepositry $Country){

        $this->Country = $Country;

        $this->middleware('permission:country-list', ['only' => ['index']]);
        $this->middleware('permission:country-create', ['only' => ['create','store']]);
        $this->middleware('permission:country-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:country-delete', ['only' => ['destroy']]);

    }
    public function index(Request $request)
    {
        return $this->Country->index($request);
    }


    public function store(CountryRequest $request)
    {
        return $this->Country->store($request);
    }

    public function update(CountryRequest $request, Country $country)
    {
        return $this->Country->update($request,$country);
    }

    public function destroy(Country $country)
    {
        return $this->Country->destroy($country);
    }
}
