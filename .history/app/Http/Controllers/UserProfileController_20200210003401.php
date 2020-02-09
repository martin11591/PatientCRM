<?php

namespace App\Http\Controllers;

use App\User;
use App\UserProfile;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{

    protected $hidden;

    public function __construct() {
        $this->middleware('auth');
        $this->hide = ['id', 'user_id', 'birth_zip_code', 'birth_city', 'birth_country', 'registered_zip_code', 'registered_city', 'registered_country', 'correspondence_zip_code', 'correspondence_city', 'correspondence_country'];
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
     * @param  \Integer  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = null)
    {
        /**
         * If ID is not given, then take ID of currently authenticated user
         * then search for user profile with that ID
         * 
         * If ID is given then simply search for user profile with that ID
         */
        $userProfile = $this->getUserProfile($id);
        /**
         * Merge separated fields into one
         */
        $this->mergeFields($userProfile);
        // $fields = $this->regroupKeys($userProfile, true);
        /**
         * Preparing field list for blade template, so we
         * don't give field which we don't want to show
         */
        $fields = $this->prepareFieldsList([
            'fields' => array_keys($userProfile->getAttributes()),
            'hidden' => $this->hidden
        ]);
        // $email = $userProfile->email;
        // unset($data['user_id']); // client don't need user_id to show
        $data = [
            'fields' => $fields,
            'profile' => $userProfile
        ];
        /**
         * If there exists user with ID listed in user profile, then
         * let's give it in case
         */
        if (!!$userProfile->user_id) $data['user'] = User::find($userProfile->user_id);

        return view('profile.show', $data);
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

    protected function regroupKeys(UserProfile $userProfile, $skipNull = false) {
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
         * @param bool  $skipNull
         * @return \Array
         */

        $attributes = $userProfile->getAttributes();
        $keys = [];
        foreach ($attributes as $field => $attribute) {
            if ($skipNull === true && $attribute == null) continue;
            $field = trim($field, "_");
            if (strpos($field, "_") === false) $keys[$field] = $attribute;
            else {
                $category = substr($field, 0, strpos($field, "_"));
                $field = substr($field, strpos($field, "_") + 1);
                if (!isset($keys[$category])) $keys[$category] = [];
                $keys[$category][$field] = $attribute;
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
            'phone' => 'numeric',
            'registered_*' => 'nullable',
            'correspondence_*' => 'nullable',
            '*' => 'required'
        ]);
    }

    protected function getUserProfile($id = null) {
        if ($id === null) {
            $id = auth()->user()->id;
            return UserProfile::where('user_id', $id)->firstOrFail();
        } else return UserProfile::findOrFail($id);
    }

    protected function mergeFields(&$userProfile) {
        $userProfile->birth = ($userProfile->birth_zip_code != null ? $userProfile->birth_zip_code . ' ' : '') . ($userProfile->birth_city != null ? $userProfile->birth_city . ', ' : '') . ($userProfile->birth_country != null ? $userProfile->birth_country : '');
        $userProfile->registered = ($userProfile->registered_zip_code != null ? $userProfile->registered_zip_code . ' ' : '') . ($userProfile->registered_city != null ? $userProfile->registered_city . ', ' : '') . ($userProfile->registered_country != null ? $userProfile->registered_country : '');
        $userProfile->correspondence = ($userProfile->correspondence_zip_code != null ? $userProfile->correspondence_zip_code . ' ' : '') . ($userProfile->correspondence_city != null ? $userProfile->correspondence_city . ', ' : '') . ($userProfile->correspondence_country != null ? $userProfile->correspondence_country : '');
    }

    protected function prepareFieldsList($opt) {
        return array_values(array_diff($opt['fields'], $opt['hidden']));
    }

    protected function isUserGiven(UserProfile $userProfile) {
        if (!$userProfile->exists) {
            return UserProfile::where('user_id', auth()->user()->id)->firstOrFail();
        }
        else return $userProfile;
    }
}
