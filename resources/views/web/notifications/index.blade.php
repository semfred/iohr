@extends('layouts.web.master')

@section('title')

@stop

@section('content')
<div class="row">
    <div class="col-md-10 offset-md-1">
        <h1>Notifications</h1>
        <div class="card">
            <div class="card-body" style="padding:0;">
                <div class="list-group list-group-flush">
                @foreach($notifications as $i => $notification)
                    <a href="{{ route('web.notifications.show', $notification->id) }}" class="list-group-item list-group-item-action {{ !$notification->read_at ? 'active' : '' }}">

                        {{--  <div class="d-flex w-100 justify-content-between">
                            <small>{{ $notification->created_at->diffForHumans() }}</small>
                        </div>  --}}

                        <p class="mb-1">
                            @if($notification->type == 'App\Notifications\LeaveRequestSent')
                                Leave Request has been added by {{ \App\Employee::find($notification->data['leave']['employee_id'])->name }}
                            @else
                                @if($notification->data['leave']['status'] == 'CAN')
                                    {{ \App\Employee::find($notification->data['leave']['employee_id'])->name }} has Cancelled a leave
                                @else
                                    Your leave has been {{ getStatus($notification->data['leave']['status']) }} by {{ \App\User::find($notification->data['leave']['employee_id'])->employee_info->name }}
                                @endif
                            @endif
                        </p>
                        <small>{{ $notification->created_at->diffForHumans() }}</small>
                    </a>
                @endforeach
                </div>
            </div>
        </div>
        @isset($notifications)
            <h3 class="text-gray-500 mt-3 text-center small">
                No Notifications Available..
            </h3>
        @endisset
        {{--  <h5 class="mt-3">
            <a href="{{ route('web.notifications.markallasread') }}" class="text-gray-500 small">
                <small>Mark all as read</small>
            </a>
        </h5>  --}}
    </div>
</div>
@stop
