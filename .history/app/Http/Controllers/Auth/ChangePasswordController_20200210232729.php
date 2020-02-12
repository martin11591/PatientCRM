<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class ChangePasswordController extends Controller
{
    public function __construct() {
        $this->middleware('verified');
    }

    public function show() {
        return view('profile.change_password', User::findOrFail(auth()->user()->id));
    }

    public function update(Request $request) {
        $user = User::findOrFail(auth()->user()->id);
        dd(Hash::check($request->current_password, $user->password), $request);
    }
}
