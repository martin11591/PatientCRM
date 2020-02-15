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

        /**
         * Merge separated fields into one
         */
        $this->mergeFields($data->userProfile);
        // $fields = $this->regroupKeys($data->userProfile, true);

        /**
         * Preparing field list for blade template, so we
         * don't give field which we don't want to show
         */
        $fields = $this->prepareFieldsList([
            'fields' => array_keys($data->userProfile->getAttributes()),
            'hide' => $this->hide
        ]);

        // $email = $data->userProfile->email;
        // unset($data['user_id']); // client don't need user_id to show

        $data = [
            'fields' => $fields,
            'profile' => $data->userProfile
        ];

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

    private function get(?UserProfile $id) {
        /**
         * If UserProfile is given and it is not current logged user, authorize him
         */
        if ($id->id !== null) $this->authorize('view', $id);

        /**
         * If UserProfile is not given, get UserProfile by current logged user ID
         */
        else $id = UserProfile::where('user_id', auth()->user()->id)->firstOrFail();

        /**
         * And get corresponding User data
         */
        $user = User::find($id->user_id);

        $return = new \stdClass();
        $return->user = $user;
        $return->userProfile = $id;
        return $return;
    }
}
