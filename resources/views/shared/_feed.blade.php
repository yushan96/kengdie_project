@if (count($feed_items))
    <ol class="notes">
        @foreach ($feed_items as $note)
            @include('notes._note', ['user' => $note->user])
        @endforeach
        {!! $feed_items->render() !!}
    </ol>
@endif