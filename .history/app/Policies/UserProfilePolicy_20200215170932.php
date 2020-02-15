<?php

namespace App\Policies;

use App\User;
use App\UserProfile;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserProfilePolicy
{
    /**
     * Groups
     */
    public const SUPERUSER    = 1;
    public const DOCTOR       = 2;
    public const RECEPTIONIST = 3;
    public const PATIENT      = 4;

    /**
     * Rights
     */
    public const CAN_CREATE = 0b1000;
    public const CAN_READ   = 0b0100;
    public const CAN_UPDATE = 0b0010;
    public const CAN_DELETE = 0b0001;

    use HandlesAuthorization;

    /**
     * Get user groups
     * 
     * @param \App\User $user
     * @return \Array
     */
    private function getGroup(User $user) {
        $groups = $user->groups()->get();
        return $groups;
    }

    /**
     * Return array containing merged IDs and names
     * for checking and to use in template
     */
    private function getGroupsID($groups) {        
        /**
         * Prepare array with IDs and names
         */
        $array = ['groups' => 0, 'names' => ""];
        foreach ($groups as $group) {
            /**
             * Toggle group flags
             * Groups are numbered from 1 to 4
             * We change it from number to bit number
             */
            $array['groups'] |= (1 << (5 - $group->id) - 1);
            $array['names'] .= ($array['names'] != "" ? ", ": "") . trans("groups.{$group->name}");
        }
        return $array;
    }

    /**
     * Check if given user groups are in single group
     */
    private function isInGroup($givenGroup, $groupToCheck) {
        return $groupToCheck == $groupToCheck & $givenGroup;
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
        $groups = $this->getGroup($user);
        $groupsID = $this->getGroupsID($groups);
        dd(decbin($groupsID['groups']), $this->isInGroup($groupsID, self::SUPERUSER));
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
