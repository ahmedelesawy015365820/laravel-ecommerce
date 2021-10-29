<?php

namespace App\Repositery\State;

interface StateInterfaceRepositry {

    public function index($request);

    public function store($request);

    public function update($request, $state);

    public function destroy($state);

}
