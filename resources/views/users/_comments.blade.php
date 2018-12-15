@if (count($comments))

    <ul class="list-group">
        @foreach ($comments as $comment)
            <li class="list-group-item">
                {{--<a href="{{ $comment->note->link(['#reply' . $comment->commentid]) }}">--}}
                    {{--{{ $comment->note->title }}--}}
                {{--</a>--}}

                <div class="reply-content" style="margin: 6px 0;">
                    {!! $comment->commenttext !!}
                </div>

            </li>
        @endforeach
    </ul>

@else
    <div class="empty-block">There is no data right now ~_~ </div>
@endif

{{-- 分页 --}}
{{--{!! $comments->appends(Request::except('page'))->render() !!}--}}