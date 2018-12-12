<div class="reply-list">
    @foreach ($comments as $comment)
        <div class=" media"  name="comment{{ $comment->commentid }}" id="comment{{ $comment->commentid }}">
            <div class="avatar pull-left">
                <a href="{{ route('users.show', [$comment->uid]) }}"></a>
            </div>

            <div class="infos">
                <div class="media-heading">
                    <a href="{{ route('users.show', [$comment->uid]) }}" title="{{ $comment->user->uname }}">
                        {{ $comment->user->uname }}
                    </a>
                    <span> •  </span>

                    {{-- 回复删除按钮 --}}
                    @can('destroy', $comment)
                    <span class="meta pull-right">
                        <form action="{{ route('comments.destroy', $comment->commentid) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-default btn-xs pull-left">
                                <i class="glyphicon glyphicon-trash"></i>
                            </button>
                        </form>
                    </span>
                    @endcan
                </div>
                <div class="reply-content">
                    {!! $comment->commenttext !!}
                </div>
            </div>
        </div>
        <hr>
    @endforeach
</div>