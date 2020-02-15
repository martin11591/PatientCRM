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
     * Return ID as enabled bits
     */
    private function getGroupsID($groups) {        
        /**
         * Prepare array with IDs and names
         */
        $id = 0;
        foreach ($groups as $group) {
            /**
             * Toggle group flags
             * Groups are numbered from 1 to 4
             * We change it from number to bit number
             */
            $id |= (1 << (5 - $group->id) - 1);
        }
        return $id;
    }

    /**
     * Return names to use in template
     */
    private function getGroupsNames($groups) {
        $names = "";
        foreach ($groups as $group) $names .= ($names != "" ? ", ": "") . trans("groups.{$group->name}");
        return $names;
    }
    /**
     * Check if given user groups are in single group
     * With this we can check if user belongs to selected group or groups
     * (single group only or few groups - if more than one, then it must be all of them; returns false if not)
     */
    private function isInGroup($givenGroup, $groupToCheck) {
        $groupToCheck = 1 << ((5 - $groupToCheck) - 1);
        return $groupToCheck === ($groupToCheck & $givenGroup);
    }

    private function isUserInGroup(User $user, $groupToCheck) {
        $groups = $this->getGroup($user);
        $groupsID = $this->getGroupsID($groups);
        return $this->isInGroup($groupsID, $groupToCheck);
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
         * Patient can't see profiles of others
         * But any other group can
         */
        return (!($this->isUserInGroup($user, self::PATIENT))) || ($this->isUserInGroup($user, self::RECEPTIONIST)) || ($this->isUserInGroup($user, self::DOCTOR)) || ($this->isUserInGroup($user, self::SUPERUSER));
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
