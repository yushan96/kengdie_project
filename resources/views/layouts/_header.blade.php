<header class="navbar navbar-fixed-top navbar-inverse">
    <div class="container">
        <div class="col-md-offset-1 col-md-10">
            <a href="/" id="logo">OINGO</a>
            <nav>
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::check())
                        <li><a href="{{ route('users.index') }}">User List</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                {{ Auth::user()->uname }} <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="{{route('users.show',Auth::user()->uid) }}">Person Page</a> </li>
                                <li><a href="{{ route('users.edit', Auth::user()->uid) }}">Edit Profile</a></li>
                                <li><a href="{{route('user.friends',Auth::user()->uid)}}">Friends </a></li>
                                <li><a href="{{route('friendship.requests',Auth::user()->uid)}}">Friends Request</a></li>
                                <li><a href="{{route('note.new',Auth::user()->uid)}}">Add new note</a></li>
                                <li><a href="{{route('filter.create', Auth::user()->uid) }}">Find others notes</a></li>
                                <li class="divider"></li>
                                <li>
                                    <a id="logout" href="#">
                                        <form action="{{ route('logout') }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button class="btn btn-block btn-danger" type="submit" name="button">Sign out</button>
                                        </form>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @else
                    <li><a href="/help">Help</a></li>
                    <li><a href="{{ route('login') }}">Sign in</a></li>
                    <li><a href="{{route('signup')}}">Sign up</a> </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</header>