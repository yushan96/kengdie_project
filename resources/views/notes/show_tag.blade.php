<div class="col-md-offset-2 col-md-8">
    @if(!empty($tags))
        @foreach ($tags as $tag)
                <span class="label label-info">{{$tag->tagname}}</span>
        @endforeach
    @endif
</div>
