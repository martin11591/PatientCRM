<?php

namespace App\Http\Controllers;

use App\User;
use App\Group;
use Illuminate\Http\Request;

class PrivilegeController extends Controller
{
    public function check($userOrGroup = null)
    {
        /**
         * No logged user and no given user
         */
        if (auth()->user() == null && $userOrGroup == null) return false;
        dd(auth()->user(), $userOrGroup);
        if (!$userOrGroup) $userOrGroup = User::findOrfail(auth()->user()->id);
    }
}
