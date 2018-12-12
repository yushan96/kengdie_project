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
        return $currentUser->uid === $user->uid;
    }

    public function destroy(User $currentUser, User $user)
    {
        return $currentUser->is_admin && $currentUser->uid !== $user->uid;
    }

    public function unfriend(User $currentUser, User $user)
    {
        return Friendship::isfriend($currentUser,$user);
    }

}