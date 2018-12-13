<div class="reply-box">
    <form action="{{ route('replystore') }}" method="POST" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="noteid" value="{{ $comment->noteid }}">
        <input type="hidden" name="commentid" value="{{ $comment->commentid }}">
        <div class="form-group" align="right">
            <textarea style="width: 50%;" class="form-control"  rows="1" placeholder="分享你的想法" name="commenttext"></textarea>
        </div>
        <div align="right">
            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-share"></i>回复</button>
        </div>

    </form>
</div>
<hr>