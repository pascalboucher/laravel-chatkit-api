<?php

namespace Chess\Chatkit\Endpoints;

use Chess\Chatkit\Models\User;
use Illuminate\Support\Collection;

class Users extends AbstractEndpoint
{
    /**
     * Get all users.
     * https://docs.pusher.com/chatkit/reference/api#get-users
     *
     * @param  string $fromTs
     * @return \Illuminate\Support\Collection
     */
    public function index($fromTs = ''): Collection
    {
        $data = ($fromTs) ? ['from_ts' => $fromTs] : [];

        return $this->get('/users', $data);
    }

    /**
     * Create a user. (sudo)
     * https://docs.pusher.com/chatkit/reference/api#creating-a-user
     *
     * @param  array $user
     * @return \Chess\Chatkit\Models\User
     */
    public function store(array $user): User
    {
        return $this->post('/users', $user);
    }

    /**
     * Create multiple users at once. (sudo)
     * https://docs.pusher.com/chatkit/reference/api#batch-creating-users
     *
     * @param  array $users
     * @return \Illuminate\Support\Collection
     */
    public function storeMultiple(array $users): Collection
    {
        return $this->post('/batch_users', ['users' => $users]);
    }

    /**
     * Get a user.
     * https://docs.pusher.com/chatkit/reference/api#get-user
     *
     * @param  string $userId
     * @return \Chess\Chatkit\Models\User
     */
    public function show($userId): User
    {
        return $this->get(sprintf('/users/%s', $userId));
    }

    /**
     * Get users by id.
     * https://docs.pusher.com/chatkit/reference/api#get-users-by-ids
     *
     * @param  array $usersIds
     * @return \Illuminate\Support\Collection
     */
    public function showMultiple(array $usersIds): Collection
    {
        return $this->get('/users_by_ids', ['user_ids' => implode(',', $usersIds)]);
    }

    /**
     * Update a user.
     * https://docs.pusher.com/chatkit/reference/api#updating-a-user
     *
     * @param  string $userId
     * @param  array  $userData
     * @return bool
     */
    public function update($userId, array $userData) : bool
    {
        return $this->put(sprintf('/users/%s', $userId), $userData);
    }

    /**
     * Delete a user. (sudo)
     * https://docs.pusher.com/chatkit/reference/api#deleting-a-user
     *
     * @param  string $userId
     * @return bool
     */
    public function destroy($userId) : bool
    {
        return $this->delete(sprintf('/users/%s', $userId));
    }
}
