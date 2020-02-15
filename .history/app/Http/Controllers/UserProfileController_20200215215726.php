<?php

namespace App\Http\Controllers;

use App\User;
use App\UserProfile;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    /**
     * User must be logged and verified to get data
     */
    public function __construct() {
        $this->hide = ['id', 'user_id', 'birth_zip_code', 'birth_city', 'birth_country', 'registered_zip_code', 'registered_city', 'registered_country', 'correspondence_zip_code', 'correspondence_city', 'correspondence_country'];
        $this->middleware(['auth', 'verified']);
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
    public function show(?UserProfile $id)
    {
        $data = $this->get($id);
        $this->authorize('check', $data['userProfile'], $data['user']);

        /**
         * Merge separated fields into one
         */
        $this->mergeFields($data['userProfile']);
        // $fields = $this->regroupKeys($data['userProfile'], true);

        /**
         * Preparing field list for blade template, so we
         * don't give field which we don't want to show
         */

        $data = array_merge($data, [
            'fields' => $this->prepareFieldsList([
                'fields' => array_keys($data['userProfile']->getAttributes()),
                'hide' => $this->hide
            ]),
            'groups' => $this->getGroupsNames($data['user']),
            'profile' => $data['userProfile']
        ]);

        return view('profile.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(?UserProfile $id)
    {
        $data = $this->get($id);
        $this->authorize('check', $data['userProfile'], $data['user']);

        $data = array_merge($data, [
            'fields' => $this->prepareFieldsList([
                'fields' => array_keys($data['userProfile']->getAttributes()),
                'hide' => ['id', 'user_id']
            ]),
            'groups' => $this->getGroupsNames($data['user']),
            'profile' => $data['userProfile']
        ]);

        return view('profile.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserProfile $id)
    {
        if ($id->id === null) return redirect(route('profile.show'))->with('message', 'profile.data_update_error_id_not_given');

        $profile = $this->get($id);
        $this->authorize('check', $profile['userProfile'], $profile['user']);

        $data = $this->validateData();

        /**
         * Leave only same keys that UserProfile Model has
         */
        dd(array_intersect_key($data, $id->getAttributes()));
        $id->update(array_intersect_key($data, $id->getAttributes()));
        
        if ($profile['user']->email !== null) $profile['user']->update(array_intersect_key($data, $profile['user']->getAttributes()));

        return redirect(route('profile.show', $id))->with('message', 'profile.data_update_success');
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

    private function get(?UserProfile $userProfile = null, ?user $user = null) {
        /**
         * If UserProfile is not given, get UserProfile by current logged user ID
         */
        if (!$userProfile || $userProfile->id === null) $userProfile = UserProfile::where('user_id', auth()->user()->id)->firstOrFail();

        /**
         * And get corresponding User data
         */
        if (!$user || $user->id === null || User::where('id', $userProfile->user_id)->id === null) $user = User::find($userProfile->user_id);
        else $user = new User;

        return [
            'user' => $user,
            'userProfile' => $userProfile,
        ];
    }

    /**
     * Return names to use in template
     */
    private function getGroupsNames(?User $user) {
        if ($user !== null) $groups = $user->groups()->orderBy('id')->distinct()->get();
        else $groups = [];
        return $groups;
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
        ]);
    }

    protected function mergeFields($userProfile) {
        $userProfile->birth = ($userProfile->birth_zip_code != null ? $userProfile->birth_zip_code . ' ' : '') . ($userProfile->birth_city != null ? $userProfile->birth_city . ', ' : '') . ($userProfile->birth_country != null ? $userProfile->birth_country : '');
        $userProfile->registered = ($userProfile->registered_zip_code != null ? $userProfile->registered_zip_code . ' ' : '') . ($userProfile->registered_city != null ? $userProfile->registered_city . ', ' : '') . ($userProfile->registered_country != null ? $userProfile->registered_country : '');
        $userProfile->correspondence = ($userProfile->correspondence_zip_code != null ? $userProfile->correspondence_zip_code . ' ' : '') . ($userProfile->correspondence_city != null ? $userProfile->correspondence_city . ', ' : '') . ($userProfile->correspondence_country != null ? $userProfile->correspondence_country : '');
        return $userProfile;
    }

    protected function prepareFieldsList($opt) {
        return array_values(array_diff($opt['fields'], $opt['hide']));
    }
}
