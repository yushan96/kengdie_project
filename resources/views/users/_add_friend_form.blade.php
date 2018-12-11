@if ($user->id !== Auth::user()->id)
    <div id="friend_form">
        @if (Auth::user()->isFollowing($user->uid))
            <form action="{{ route('friendship.destroy', $user->uid) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-sm">删除好友</button>
            </form>
        @else
            <form action="{{ route('followers.store', $user->uid) }}" method="post">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-sm btn-primary">添加好友</button>
            </form>
        @endif
    </div>
@endif