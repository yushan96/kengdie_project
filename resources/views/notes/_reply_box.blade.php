<div class="reply-box">
    <form action="{{ route('comments.store') }}" method="POST" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="noteid" value="{{ $note->noteid }}">
        <div class="form-group">
            <textarea class="form-control" rows="2" placeholder="Comment for note" name="commenttext"></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-share"></i>reply</button>
    </form>
</div>
<hr>