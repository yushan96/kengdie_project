
@if (count($feed_items)>0)
    <ol class="notes">
        @foreach ($feed_items as $note)
            @include('notes._note', ['user' => $note->user])
        @endforeach
        {!! $feed_items->render() !!}
    </ol>
@else
    <div class="alert alert-warning" role="alert">Wooops, you have no note, try to create one or find others notes</div>
@endif