@extends('layouts.web.master')

@section('title')
Requests
@stop

@section('content')
@include('web.profile.includes.nav')

<div class="row">
    <div class="col-md-8 offset-md-2 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                            <div class="card border-left-primary h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Vacation Leave Balance</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \Auth::user()->employee_info->entitlement->vacation }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-glass-cheers fa-2x text-gray-300"></i>
                                    </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="col">
                            <div class="card border-left-primary h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Sick Leave Balance</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \Auth::user()->employee_info->entitlement->sick }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-file-medical fa-2x text-gray-300"></i>
                                    </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">
                <ul class="nav justify-content-center" id="profile-nav">
                    <li class="nav-item">
                        <span class="nav-link border-right">
                            <i style="color:#4cbb87;" class="fas fa-check"></i> Approved
                        </span>
                    </li>
                    <li class="nav-item">
                        <span class="border-right nav-link"><i style="color:#f7dc6f;" class="fas fa-ban"></i> Cancelled</span>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link">
                            <i style="color:#d26759;" class="fas fa-times"></i> Declined
                        </span>
                    </li>
                </ul>
                    <div class="list-group">
                        @foreach($requests as $i => $leave)
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
                                    {{ ucfirst($leave->type) }} Leave
                                    <span>{{ $leave->note }}</span>
                                    @if(!$leave->approved)
                                        <span class="my-3"><a href="#" data-id="cancel-{{ $leave->id }}" class="cancel-leave btn btn-block btn-sm btn-outline-primary">
                                            Cancel
                                        </a></span>
                                    @endif
                                    <span class="mt-3">
                                        <small>{{ $leave->created_at->diffForHumans() }}</small>
                                    </span>
                                    <form action="{{ route('web.profile.cancel.leave', $leave) }}" id="cancel-{{ $leave->id }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="PUT">
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        @endforeach
                    </div>
            </div>
        </div>
        <div class="my-3">
            {{ $requests->links() }}
        </div>
    </div>
</div>
@stop
