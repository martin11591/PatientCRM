<?php

namespace App\Http\Controllers;

use App\User;
use App\UserProfile;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function show(UserProfile $userProfile)
    {
        $userProfile = $this->isUserGiven($userProfile);
        // $user = User::findOrFail($userProfile->user_id);
        // dd($user);
        $data = $this->regroupKeys($userProfile);
        unset($data['user_id']); // client don't need user_id to show
        return view('profile.show', [
            'profile' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(UserProfile $userProfile)
    {
        $userProfile = $this->isUserGiven($userProfile);
        return view('profile.edit', [
            'userProfile' => $userProfile,
            'profile' => $this->regroupKeys($userProfile)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserProfile $userProfile)
    {
        $userProfile = $this->isUserGiven($userProfile);

        $userProfile->update($this->validateData());

        return redirect(route('profile.show'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserProfile $userProfile)
    {
        //
    }

    protected function regroupKeys(UserProfile $userProfile) {
        /**
         * Here we iterate through every attribute of user profile data
         * then we group all attributes starting from the same word
         * in new array and skip all attributes with value: null, e.g.:
         * 
         * Array like that:
         * [
         *      'a' => 1,
         *      'b' => 1,
         *      'c' => null,
         *      'b_a' => 1,
         *      'b_b' => 1,
         * ]
         * 
         * Became this array:
         * [
         *      'a' => 1,
         *      'b' => [
         *          1,
         *          'a' => 1,
         *          'b' => 1,
         *      ]
         * ]
         * 
         * @param  \App\UserProfile  $userProfile
         * @return \Array
         */

        $attributes = $userProfile->getAttributes();
        $keys = [];
        foreach ($attributes as $field => $attribute) {
            if (true || $attribute != null) {
                $field = trim($field, "_");
                if (strpos($field, "_") === false) $keys[$field] = $attribute;
                else {
                    $category = substr($field, 0, strpos($field, "_"));
                    $field = substr($field, strpos($field, "_") + 1);
                    if (!isset($keys[$category])) $keys[$category] = [];
                    $keys[$category][$field] = $attribute;
                }
            }
        }
        
        /**
         * If there is sub-array with only one key, then we push it back
         */
        foreach ($keys as $key => $value) {
            if (gettype($value) !== "array" || count($value) != 1) continue;
            $newKey = $key . "_" . array_keys($value)[0];
            $keys[$newKey] = array_values($value)[0];
            unset($keys[$key]);
        }
        return $keys;
    }
    
    protected function validateData() {
        return request()->validate([
            'registered_*' => 'nullable',
            'correspondence_*' => 'nullable',
            '*' => 'required'
        ]);
    }

    protected function isUserGiven(UserProfile $userProfile) {
        if (!$userProfile->exists) return UserProfile::findOrFail(auth()->user()->id);
        else return $userProfile;
    }
}
