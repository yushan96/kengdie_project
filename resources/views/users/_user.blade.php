<li>
    <img src="{{ $user->gravatar() }}" alt="{{ $user->uname }}" class="gravatar"/>
    <a href="{{ route('users.show', $user->uid )}}" class="username">{{ $user->uname }}</a>

    @can('destroy', $user)
        <form action="{{ route('users.destroy', $user->uid) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-sm btn-danger delete-btn">删除</button>
        </form>
    @endcan

    @can('befriend',$user)
        <form action="{{route('user.befriend',$user->uid)}}" method="POST">
            {{csrf_field()}}
            <button type="submit" class="btn">Add Friend</button>
        </form>
    @endcan
</li>