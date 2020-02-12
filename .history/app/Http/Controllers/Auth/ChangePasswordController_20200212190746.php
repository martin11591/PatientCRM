<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Rules\SamePassword;

class ChangePasswordController extends Controller
{
    public function __construct() {
        $this->middleware('verified');
    }

    public function show() {
        return view('profile.change_password', User::findOrFail(auth()->user()->id));
    }

    public function update(Request $request) {
        /**
         * Get current authorized user (this route is only for authorized and current logged user)
         */
        $user = User::findOrFail(auth()->user()->id);
        $data = request()->validate([
            'current_password' => ['required', new SamePassword],
            'new_password' => 'nullable|confirmed'
        ]);

        /**
         * Check if given password is proper with database
         */
        $currentPassMatching = Hash::check($request->current_password, $user->password);
    }
}
