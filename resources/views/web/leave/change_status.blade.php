@extends('layouts.web.master')

@section('title')
{{ ucfirst($status) }} leave
@stop

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
            <div class="row my-3">
                    <div class="col">
                        <a href="{{ route('web.requests.change.status', ['leave' => $leave, 'status' => 'approve']) }}" class="btn btn-block btn-sm btn-outline-success {{ $status == 'approve' ? 'disabled' : '' }}">
                            Approve
                        </a>
                    </div>
                    {{-- <div class="col">
                        <a href="{{ route('web.requests.change.status', ['leave' => $leave, 'status' => 'cancel']) }}" class="btn btn-block btn-sm btn-outline-primary {{ $status == 'cancel' ? 'disabled' : '' }}">
                            Cancel
                        </a>
                    </div> --}}
                    <div class="col">
                        <a href="{{ route('web.requests.change.status', ['leave' => $leave, 'status' => 'decline']) }}" class="btn btn-block btn-sm btn-outline-danger {{ $status == 'decline' ? 'disabled' : '' }}">
                            Decline
                        </a>
                    </div>
                </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('web.requests.change.status', ['leave' => $leave, 'status' => $status]) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">

                    <h2 class="text-center">{{ ucfirst($status) }} {{ ucfirst($leave->type) }} Leave for {{ $leave->employee->name }}</h2>
                    <p class="text-center">
                        <strong>
                                <span style="border-bottom:2px solid; padding-bottom: 2px;">
                                        {{ $leave->from_date->format('F d, Y') }} - {{ $leave->to_date->format('F d, Y') }}
                                </span>
                        </strong>
                        <br>
                    @if($leave->note)
                            <blockquote class="text-center">
                                <h4 class=""><strong>From {{ $leave->employee->name }}:</strong></h4>
                                " {{ $leave->note }} "
                            </blockquote>
                        </p>
                    @else
                        <div class="text-center">
                            <small class="text-muted">
                                    <i>No Personal Note Added by {{ $leave->employee->name }}</i>
                            </small>
                        </div>
                    @endif

                    @if($leave->attachment)
                        <a href="{{ asset('storage/' . $leave->attachment->file->path) }}" target="_blank">
                            <i class="fas fa-file" style="margin-right:10px;"></i> View attached file
                        </a>
                    @endif

                    @include('web.leave.includes.leave-approval-form', $leave)
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="{{ URL::previous() }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
