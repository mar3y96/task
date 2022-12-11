<?php

namespace App\Services;

use App\Models\User;
use App\Jobs\SendDataChangeJob;

class UserService
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUsers()
    {
        return  $this->user->select('id', 'name', 'email')->get();
    }

    public function update($user, $data)
    {
        $old = $user->toArray();
        $new = [];
        $user = tap($user)->update($data);
        if ($user->wasChanged('name')) {
            array_push($new, 'your name changed , old value was => ' . $old['name'] . ' new value => ' . $user->name);
        }
        if ($user->wasChanged('email')) {
            array_push($new, 'your email changed , old value was => ' . $old['email'] . ' new value  =>' . $user->email);
        }
        if ($user->wasChanged('password')) {
            array_push($new, 'your password changed , new value => ' . $data['password']);
        }
        if (count($new) > 0) {
            dispatch(new SendDataChangeJob($user->email, $new));
        }
        return $user;
    }
}
