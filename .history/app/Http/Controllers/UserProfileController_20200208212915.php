<?php

namespace App\Http\Controllers;

use App\UserProfile;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
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
        return view('profile.show', [
            'profile' => $this->regroupKeys($userProfile)
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
        //
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
        //
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
            if ($attribute != null) {
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
}
