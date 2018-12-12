<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/12/11
 * Time: 22:34
 */

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;

class CommentPolicy
{
    public function destroy(User $currentUser,Comment $comment)
    {
        return $currentUser->uid===$comment->uid || $currentUser->uid===$comment->note()->first()->uid;
    }
}