<?php

namespace App\Repositery\User;

interface UserInterfaceRepositry {


    public function index($request);

    public function create();

    public function store($request);

    public function edit($id);

    public function update($request, $user);

    public function destroy($request);

}

