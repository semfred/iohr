@extends('layouts.web.master')

@section('title')
Create Holiday
@stop

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">

                <form action="{{ route('web.settings.holidays.store') }}" method="POST">
                    @csrf

                    @include('web.holidays.includes.form')

                    <button type="submit" class="btn btn-success">Submit</button>
                </form>

            </div>
        </div>
    </div>
</div>
@stop
