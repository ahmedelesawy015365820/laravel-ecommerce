<?php

namespace App\Repositery\Profile;


interface ProfileInterfaceRepositry {

    public function index();

    public function create();

    public function update($request, $profile);


}
