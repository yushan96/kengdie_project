@extends('layouts.default')
@section('title', "add_new_note")

@section('content')
<form action="{{ route('notes.store') }}" method="POST">
    @include('shared._errors')
    {{ csrf_field() }}
    <div>
        <textarea class="form-control"  rows="8" placeholder="input something..." name="notetext">{{ old('content') }}</textarea>
        <div class="form-group" style="width: 30%; height: auto; display: inline ">
            <p><input type="checkbox" name="tag[]" value=1 >eating</p>
            <p><input type="checkbox" name="tag[]" value=2 >shopping</p>
            <p><input type="checkbox" name="tag[]" value=3 >entertainment</p>
            <p><input type="checkbox" name="tag[]" value=4 >me</p>
            <p><input type="checkbox" name="tag[]" value=5 >holiday</p>
        </div>
        <div style="width: 50%; height: auto; display: inline ">
            <div>
                Set a state for you note:
            </div>
            <br>
            <div>
                <textarea class="form-control"  rows="3" placeholder="input the state..." name="state_text" style="width: auto">{{ old('content') }}</textarea>
            </div>
        </div>
        <div>
            Start_date:<input type="date" value="2018-12-12" name="begin_date"/>
            End_date:<input type="date" value="2018-12-12" name="end_date"/>
        </div>
        <div>Set permission:</div>
        <div class="col-md-8">
            <input type="radio" name="permission" value=0 >For everyone
            <input type="radio" name="permission" value=1 >For myself
            <input type="radio" name="permission" value=2 >For my friends
        </div>
        <br>
        <div >
            <div class="col-md-8">
                Schedule_start_date:<input type="date" value="2018-12-12" name="repeat_start"/>
                <div>Schedule by interval:</div>
                <div>input the interval (days)
                    <input type="number" value=1 name="repeat_interval">
                </div>
                <div>Schedule by repeat day:(0 represent all)</div>
                <div>
                    Every <input type="number"  name="repeat_year"  value=0 min=0 > year<br>
                    Every <input type="number"  name="repeat_month"  value=0 max=12 min=0 > month<br>
                    Every <input type="number" name="repeat_week"  value=0 max=5 min=0 > week<br>
                    Every <input type="number" name="repeat_weekday"  value=0 min=0 max=7 > day<br>
                </div>
                <div>
                    Start_time:<input type="time" value="12:00:00" name="day_start"/>
                    End_time:<input type="time" value="12:00:00" name="day_end"/>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary pull-right">Upload</button>
</form>

@stop