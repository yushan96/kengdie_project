<li id="note-{{ $note->noteid }}">
    <a href="{{ route('users.show', $user->uid )}}"></a>
    <span class="user">
    <a href="{{ route('users.show', $user->uid )}}">{{ $user->uname }}</a>
  </span>
    <div>
        <div>
            <div>Create time:  <span class="timestamp">{{ $note->created_at}}</span></div>
        </div>
        <div>
            <div>
                Note content:   <span class="content">{{ $note->notetext }}</span>
                <form action="{{route('notes.tags',$note->noteid)}}" method="get">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-sm btn-danger status-delete-btn">See tags</button>
                </form>
                @can('destroy',$note)
                    <form action="{{route('notes.destroy',$note->noteid)}}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-sm btn-danger status-delete-btn">Delete</button>
                    </form>
                @endcan

                {{--reply list--}}
                <div class="panel panel-default topic-reply">
                    <div class="panel-body">
                        @include('notes._reply_box',$note)
                        @include('notes._reply_list',$comments=$note->comments()->with('user')->get())
                    </div>
                </div>
            </div>
        </div>
    </div>
</li>