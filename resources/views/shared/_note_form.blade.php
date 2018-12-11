<form action="{{ route('notes.store') }}" method="POST">
    @include('shared._errors')
    {{ csrf_field() }}
    <div>
        <textarea class="form-control" rows="3" placeholder="input something..." name="notetext">{{ old('content') }}</textarea>
        <div class="form-group">
                    <p><input type="checkbox" name="tag[]" value=1 >eating</p>
                    <p><input type="checkbox" name="tag[]" value=2 >shopping</p>
                    <p><input type="checkbox" name="tag[]" value=3 >entertainment</p>
                    <p><input type="checkbox" name="tag[]" value=4 >me</p>
                    <p><input type="checkbox" name="tag[]" value=5 >holiday</p>
                    Start_date:<input type="date" value="2018-12-12" name="begin_date"/>
                    End_date:<input type="date" value="2018-12-12" name="end_date"/>
        </div>
        <div>
            <input type="radio" name="permission" value=0 >For everyone
            <input type="radio" name="permission" value=1 >For myself
            <input type="radio" name="permission" value=2 >For my friends
        </div>
    </div>
    <button type="submit" class="btn btn-primary pull-right">Upload</button>
</form>