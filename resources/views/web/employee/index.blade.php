@extends('layouts.web.master')

@section('title')
    Employees
@stop

@section('content')
<div class="row">
    <div class="col text-right" style="margin:10px 0;">
        <a href="{{ route('web.employees.create') }}" class="btn btn-success">Add Employee Record</a>
    </div>
</div>
<div class="row">
    <div class="col-md-8 offset-md-2">
        @foreach($employees as $i => $employee)
        <div class="card mb-2">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-white">{{ '#00' . $employee->id }} {{ $employee->name }}</h6>
              <div class="dropdown no-arrow">
                    {!! isset($employee->employment->position) ? '<span class="badge badge-primary">'.$employee->employment->position->name.'</span>' : '' !!}
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                  {{-- <div class="dropdown-header">Actions:</div> --}}
                  {{-- @if(!$employee->user->email_verified_at)
                    <a class="dropdown-item" href="{{ route('web.employees.resendverification', $employee) }}">Resend Verification</a>
                @endif --}}
                  <a class="dropdown-item" href="{{ route('web.employees.edit', $employee) }}">Edit</a>
                  @if(Auth::user()->employee_id !== $employee->id)
                  <div class="dropdown-divider"></div>
                    <a class="dropdown-item btn-delete" href="#" data-id="deleteEmployee{{ $employee->id }}">Remove</a>
                  @endif
                </div>
              </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                    <p>{{ $employee->email }}</p>
                    {{-- <p>
                        {!! ($employee->user->email_verified_at) ? '<small class="text-success">User Verified</small>' : '<small class="text-danger">User Not Yet Verified</small>' !!}
                    </p> --}}
            </div>
          </div>
          <form id="deleteEmployee{{ $employee->id }}" action="{{ route('web.employees.destroy', $employee) }}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="DELETE">
          </form>
        @endforeach
        {{ $employees->links() }}
    </div>
</div>

@stop
