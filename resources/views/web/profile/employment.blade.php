@extends('layouts.web.master')

@section('title')

@stop

@section('content')
@include('web.profile.includes.nav')

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">
                @include('web.profile.includes.employment')
            </div>
        </div>
    </div>
</div>
@stop
