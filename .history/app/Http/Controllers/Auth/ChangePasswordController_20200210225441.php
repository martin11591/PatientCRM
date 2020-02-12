<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use App\User;

class ChangePasswordController extends Controller
{
    public function __construct() {
        $this->middleware('verified');
    }

    public function show() {
        dd(auth()->user());
        return view('profile.change_password', User::findOrFail(user()->auth()->id));
    }

    public function update(Request $request) {

    }
}
