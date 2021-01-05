@extends('layouts.web.master')

@section('title')
Edit {{ $position->name }}
@stop

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        Current Employee Count for {{ $position->name }}: <spam class="text-success">{{ $position->employees->count() }}</spam>
                    </div>
                </div>
                <form action="{{ route('web.positions.update', $position) }}" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}

                    @include('web.positions.includes.form', $position)

                    <button type="submit" class="btn btn-success">Save Changes</button>
                </form>

            </div>
        </div>
    </div>
</div>
@stop
