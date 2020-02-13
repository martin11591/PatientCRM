<?php

namespace App\Http\Controllers;

use App\User;
use App\Group;
use Illuminate\Http\Request;

class PrivilegeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function check($userOrGroup = null)
    {
        dd(auth()->user(), $userOrGroup);
        if (!$userOrGroup) $userOrGroup = User::findOrfail(auth()->user()->id);
    }
}
