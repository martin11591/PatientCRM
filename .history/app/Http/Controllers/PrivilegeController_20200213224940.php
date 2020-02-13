<?php

namespace App\Http\Controllers;

use App\User;
use App\Group;
use Illuminate\Http\Request;

class PrivilegeController extends Controller
{
    public function check($userOrGroup = null)
    {
        if (!$userOrGroup) $userOrGroup = User::findOrfail(auth()->user()->id);
        dd($userOrGroup);
    }
}
