@extends('layouts.web.master')

@section('title')
Create Leave Request
@stop

@section('content')
<h2>Leave Request</h2>
<hr>
{{-- @if(!\Auth::user()->employee_info->employment->isPermanent())
<div id="overlay">
    <div class="text">
        LEAVE REQUESTS ARE FOR REGULAR EMPLOYEES ONLY
    </div>
</div>
@endif --}}
<div class="row">
    <div class="col">

        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('web.requests.store') }}" method="POST" enctype="multipart/form-data">

                            {{ csrf_field() }}

                            @include('web.leave.includes.leave-request-form')
                            {{-- @if(\Auth::user()->employee_info->employment->permanent) --}}
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-10">
                                        <button type="submit" class="btn btn-success">Send Request</button>
                                    </div>
                                </div>
                            {{-- @endif --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-md-5">
        <div id="leaveCalendar"></div>
    </div>
</div>

@stop
