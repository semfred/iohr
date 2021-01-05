@extends('layouts.web.master')

@section('title')
Change Password
@stop

@section('content')
@include('web.profile.includes.nav')

@if(!Auth::user()->password_changed)
<div class="alert alert-success alert-dismissible fade show">
    You have the default password, please change it before proceeding.
</div>
@endif
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('web.profile.updatepassword', $user) }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">

                    @include('web.profile.includes.change_password')

                    <button type="submit" class="btn btn-submit btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
