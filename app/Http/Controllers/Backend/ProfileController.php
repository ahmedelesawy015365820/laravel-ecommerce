<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\User;
use App\Repositery\Profile\ProfileInterfaceRepositry;

class ProfileController extends Controller
{

    protected $profile;

    public function  __construct(ProfileInterfaceRepositry $profile )
    {
        $this->profile = $profile;
    }

    public function index()
    {
        return $this->profile->index();
    }


    public function create()
    {
        return $this->profile->create();
    }


    public function update(ProfileRequest $request, User $profile)
    {
        return $this->profile->update($request,$profile);
    }

}
