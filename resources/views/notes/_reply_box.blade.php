<div class="reply-box">
    <form action="{{ route('comments.store') }}" method="POST" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="noteid" value="{{ $note->noteid }}">
        <div class="form-group">
            <textarea class="form-control" rows="2" placeholder="分享你的想法" name="commenttext"></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-share"></i>回复</button>
    </form>
</div>
<hr>