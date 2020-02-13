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
        $userOrGroup = User::find(5);

        /**
         * If not found then disallow
         */
        dd(empty($userOrGroup));
        if ($userOrGroup->isEmpty()) return false;
    }
}
