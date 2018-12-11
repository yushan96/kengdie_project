<header class="navbar navbar-fixed-top navbar-inverse">
    <div class="container">
        <div class="col-md-offset-1 col-md-10">
            <a href="/" id="logo">OINGO</a>
            <nav>
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::check())
                        <li><a href="{{ route('users.index') }}">User list</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                {{ Auth::user()->uname }} <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="{{route('users.show',Auth::user()->uid) }}">personal</a> </li>
                                <li><a href="{{ route('users.edit', Auth::user()->uid) }}">Edit profile</a></li>
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