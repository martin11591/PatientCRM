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
        if (!$userOrGroup) $userOrGroup = User::find(auth()->user()->id);
        $userOrGroup = null;

        /**
         * If not found then disallow
         */
        if (!$userOrGroup) return false;
        dd($userOrGroup);
    }
}
