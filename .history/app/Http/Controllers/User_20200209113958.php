<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class User extends Controller
{
    protected function getPrivileges(User $user) {
        dd($user);
    }
}
