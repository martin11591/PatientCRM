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

        /**
         * Not given user, check for logged user
         */
        dd(User::find(1));
        if (!$userOrGroup) $userOrGroup = User::findOrfail(auth()->user()->id);
    }
}
