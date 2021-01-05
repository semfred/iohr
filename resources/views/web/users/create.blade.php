@extends('layouts.web.master')

@section('title')
Create User
@stop

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('web.users.store') }}" method="POST">
                    {{ csrf_field() }}
                    @include('web.users.includes.form')
                    <button class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
