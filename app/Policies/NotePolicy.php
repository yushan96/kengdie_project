<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/12/10
 * Time: 0:39
 */

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;
use App\Models\Note;


class NotePolicy
{
    use HandlesAuthorization;

    public function destroy(User $user, Note $note)
    {
        return $user->uid === $note->uid;
    }
}