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
</li>