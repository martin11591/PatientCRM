<?php

namespace App\Policies;

use App\User;
use App\UserProfile;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserProfilePolicy
{
    public const CAN_CREATE = 0b1000;
    public const CAN_READ = 0b0100;
    public const CAN_UPDATE = 0b0010;
    public const CAN_DELETE = 0b0001;

    use HandlesAuthorization;

    /**
     * Get user group
     */
    private function getGroup(User $user) {
        dd($user->groups());
        return null;
    }

    /**
     * Determine whether the user can view any user profiles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the user profile.
     *
     * @param  \App\User  $user
     * @param  \App\UserProfile  $userProfile
     * @return mixed
     */
    public function view(?User $user, UserProfile $userProfile)
    {
        /**
         * Show all user data and user profile data only to superuser group
         */
        dd($this->getGroup($user));
        return true;
    }

    /**
     * Determine whether the user can create user profiles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the user profile.
     *
     * @param  \App\User  $user
     * @param  \App\UserProfile  $userProfile
     * @return mixed
     */
    public function update(User $user, UserProfile $userProfile)
    {
        //
    }

    /**
     * Determine whether the user can delete the user profile.
     *
     * @param  \App\User  $user
     * @param  \App\UserProfile  $userProfile
     * @return mixed
     */
    public function delete(User $user, UserProfile $userProfile)
    {
        //
    }

    /**
     * Determine whether the user can restore the user profile.
     *
     * @param  \App\User  $user
     * @param  \App\UserProfile  $userProfile
     * @return mixed
     */
    public function restore(User $user, UserProfile $userProfile)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the user profile.
     *
     * @param  \App\User  $user
     * @param  \App\UserProfile  $userProfile
     * @return mixed
     */
    public function forceDelete(User $user, UserProfile $userProfile)
    {
        //
    }
}
