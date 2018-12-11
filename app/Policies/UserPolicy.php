<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;
use App\Models\Friendship;

class UserPolicy
{
    use HandlesAuthorization;

    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }

    public function destroy(User $currentUser, User $user)
    {
        return $currentUser->is_admin && $currentUser->uid !== $user->uid;
    }

    public function unfriend(User $currentUser, User $user)
    {
        return Friendship::isFriend($currentUser,$user);
    }

    public function befriend(User $currentUser, User $user)
    {
        //todo 如果是已经发送请求了，区分一下
        return !Friendship::isFriend($currentUser,$user);
    }

}