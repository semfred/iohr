@extends('layouts.web.master')

@section('title')
    Leave
@stop

@section('content')
<div class="row" style="margin-bottom:2em;">

<div class="col-md-8 offset-md-2">
    <div class="row">
            <div class="col text-center">
                    <div id="filters" class="btn-group btn-group-sm">
                        <a href="{{ route('web.requests.index', ['status' =>  Request::get('status')]) }}" class="btn btn-link border-right active" data-filter="*">Show All</a>
                        <a href="{{ route('web.requests.index', ['type' =>  'vacation', 'status'    =>  Request::get('status')]) }}" class="btn btn-link border-right active" data-filter=".vacation">Vacation</a>
                        <a href="{{ route('web.requests.index', ['type' =>  'sick', 'status'    =>  Request::get('status')]) }}" class="btn btn-link border-right" data-filter=".sick">Sick</a>
                        <a href="{{ route('web.requests.index', ['type' =>  'other', 'status'   =>  Request::get('status')]) }}" class="btn btn-link" data-filter="other">Other</a>
                    </div>
                </div>

                <div class="col text-center">
                        <div id="sorts" class="btn-group btn-group-sm">
                            <a href="{{ route('web.requests.index', ['type'   =>  Request::get('type')]) }}" class="btn btn-link border-right" data-sort-by="original-order">Default</a>
                            <a href="{{ route('web.requests.index', ['status'   =>  'PENDING', 'type'   =>  Request::get('type')]) }}" class="btn btn-link border-right" data-sort-by="pending">Pending</a>
                            <a href="{{ route('web.requests.index', ['status'   =>  'APP', 'type'   =>  Request::get('type')]) }}" class="btn btn-link border-right" data-sort-by="approved">Approved</a>
                            {{-- <a href="{{ route('web.requests.index', ['status'   =>  'CAN', 'type'   =>  Request::get('type')]) }}" class="btn btn-link border-right" data-sort-by="canceled">Canceled</a> --}}
                            <a href="{{ route('web.requests.index', ['status'   =>  'DEC', 'type'   =>  Request::get('type')]) }}" class="btn btn-link" data-sort-by="declined">Declined</a>
                        </div>
                </div>
    </div>
</div>

</div>

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">
                    @foreach($leaves as $i => $leave)
                    <div class="leave-item">
                        <div class="leave-icon status-{{ $leave->status }}">
                            <a href="#" data-status="{{ getStatus($leave->status) }}" class="{{ $leave->status !== 'PENDING' ? 'leave-stat' : '' }}" style="color: white" data-name="{{ isset($leave->approveUser) ? $leave->approveUser->employee_info->name : '' }}" data-statusnote="{{ $leave->status_note }}">
                                    @if($leave->status == 'APP')
                                        <i class="fas fa-check"></i>
                                    @elseif($leave->status == 'CAN')
                                        <i class="fas fa-ban"></i>
                                    @elseif($leave->status == 'DEC')
                                        <i class="fas fa-times"></i>
                                    @else
                                        <i class="fas fa-ellipsis-h"></i>
                                    @endif
                            </a>
                        </div>
                        <div class="leave-date">{{ $leave->from_date->format('F d, Y') }}<span>To {{ $leave->to_date->format('F d, Y') }}</span></div>
                        <div class="leave-content">
                            {{ ucfirst($leave->type) }} Leave for {{ $leave->employee->name }}
                            <span>{{ $leave->note }}</span>
                            @if(!$leave->approved)
                                @if(Auth::user()->employee_id !== $leave->employee_id)
                                    <div class="row my-3">
                                        <div class="col">
                                            <a href="{{ route('web.requests.change.status', ['leave' => $leave, 'status' => 'approve']) }}" class="btn btn-block btn-sm btn-outline-success {{ $leave->status == 'APP' ? 'disabled' : $leave->approved ? 'disabled' : '' }}">
                                                Approve
                                            </a>
                                        </div>
                                        {{-- <div class="col">
                                            <a href="{{ route('web.requests.change.status', ['leave' => $leave, 'status' => 'cancel']) }}" class="btn btn-block btn-sm btn-outline-primary {{ $leave->status == 'APP' ? 'disabled' : $leave->approved ? 'disabled' : '' }}">
                                                Cancel
                                            </a>
                                        </div> --}}
                                        <div class="col">
                                            <a href="{{ route('web.requests.change.status', ['leave' => $leave, 'status' => 'decline']) }}" class="btn btn-block btn-sm btn-outline-danger {{ $leave->status == 'APP' ? 'disabled' : $leave->approved ? 'disabled' : '' }}">
                                                Decline
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    @if(Auth::user()->superuser)
                                        <div class="row my-3">
                                            <div class="col">
                                                <a href="{{ route('web.requests.change.status', ['leave' => $leave, 'status' => 'approve']) }}" class="btn btn-block btn-sm btn-outline-success {{ $leave->status == 'APP' ? 'disabled' : $leave->approved ? 'disabled' : '' }}">
                                                    Approve
                                                </a>
                                            </div>
                                            {{-- <div class="col">
                                                <a href="{{ route('web.requests.change.status', ['leave' => $leave, 'status' => 'cancel']) }}" class="btn btn-block btn-sm btn-outline-primary {{ $leave->status == 'APP' ? 'disabled' : $leave->approved ? 'disabled' : '' }}">
                                                    Cancel
                                                </a>
                                            </div> --}}
                                            <div class="col">
                                                <a href="{{ route('web.requests.change.status', ['leave' => $leave, 'status' => 'decline']) }}" class="btn btn-block btn-sm btn-outline-danger {{ $leave->status == 'APP' ? 'disabled' : $leave->approved ? 'disabled' : '' }}">
                                                    Decline
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @else
                            <div class="my-3">
                                <span>{!! $leave->status !== 'CAN' ? 'Approved By: <strong>'. $leave->approveUser->employee_info->name .'</strong>' : '' !!}</span>
                                <span>{!! $leave->status_note ? 'Note: <strong>' . $leave->status_note . '</strong>' : '' !!}</span>
                                <span>{!! $leave->attachment ? '<a href="'.asset('storage/' . $leave->attachment->file->path).'" target="_blank">View attached file</a>' : '' !!}</span>
                            </div>
                            @endif
                            <span class="mt-3">
                                <small>Last updated {{ $leave->created_at->diffForHumans() }}</small>
                            </span>
                            <hr>
                        </div>
                    </div>
                    @endforeach
            </div>
        </div>
        <div class="my-3">
                {{ $leaves->links() }}
        </div>
    </div>
</div>
@stop
