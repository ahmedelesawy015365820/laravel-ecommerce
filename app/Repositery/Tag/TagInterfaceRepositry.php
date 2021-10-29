<?php

namespace App\Repositery\Tag;

interface TagInterfaceRepositry {

    public function index($request);

    public function store($request);

    public function update($request, $tag);

    public function destroy($request);

}
