<?php


namespace App\Repositery\Role;

interface RoleInterfaceRepositry {


    public function index($request);

    public function create();

    public function store($request);

    public function show($id);

    public function edit($id);

    public function update($request, $role);

    public function destroy($request);

}
