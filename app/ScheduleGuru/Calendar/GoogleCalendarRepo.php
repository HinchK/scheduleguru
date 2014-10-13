<?php namespace ScheduleGuru\Calendar;


class GoogleCalendarRepo {


    /**
     * Persist a user
     *
     * @param User $user
     * @return mixed
     */
    public function save(User $user)
    {
        return $user->save();
    }

    /**
     * Get a paginated list of all users
     * @param int $howMany
     * @return \Illuminate\Pagination\Paginator
     * @internal param int $howMany
     */
    public function getPaginated($howMany = 25)
    {
        return User::orderBy('username', 'asc')->simplePaginate($howMany);
    }

    /**
     * Get user object for given username
     * @param $username
     * @return mixed
     */
    public function findByUsername($username){

        return User::with('statuses')->whereUsername($username)->first();

    }

    /**
     * Find a user by ID
     * @param $id
     * @return \Illuminate\Support\Collection|static
     */
    public function findById($id)
    {

        return User::findOrFail($id);
    }

    /**
     * Follow a User
     *
     * @param $userIdToFollow
     * @param User $user
     * @return mixed
     */
    public function follow($userIdToFollow, User $user)
    {
        return $user->followedUsers()->attach($userIdToFollow);
    }

    /**
     * Unfollow a User
     *
     * @param $userIdToFollow
     * @param User $user
     * @return mixed
     */
    public function unfollow($userIdToUnfollow, User $user)
    {
        return $user->followedUsers()->detach($userIdToUnfollow);
    }

}