@extends('layouts.web.master')

@section('title')
Holidays
@stop

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <p class="text-right">
            <a href="{{ route('web.settings.holidays.create') }}" class="btn btn-success">Create Holiday</a>
            <a href="{{ route('web.settings.holidays.calendar.updateHolidayCommand') }}" class="btn btn-info">Update All Holiday</a>
        </p>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('web.settings.holidays.calendar.updateholidays') }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                <div class="row">
                        <div class="col-6">
                            <ul class="list-group list-group-flush">
                                    @foreach($holidays as $i => $holiday)
                                    <li class="list-group-control">
                                        <label class="custom-control material-checkbox">
                                            <input type="checkbox" name="holiday_{{ $holiday->id }}" {{ $holiday->active ? 'checked' : '' }} class="material-control-input">
                                            <span class="material-control-indicator"></span>
                                            <span class="material-control-description">{{$holiday->name}} ({{ date('M d', strtotime($holiday->observance)) }})</span>
                                        </label>
                                    </li>
                                    @if($loop->iteration == ceil(count($holidays) / 2))
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-group list-group-flush">
                                    @endif
                                    @endforeach
                                </ul>
                        </div>
                </div>
                <button class="btn btn-block btn-success my-3" type="submit">Update Holidays</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
