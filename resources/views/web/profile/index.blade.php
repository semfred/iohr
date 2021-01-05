@extends('layouts.web.master')

@section('title')

@stop

@section('content')
@include('web.profile.includes.nav')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('web.profile.update', $employee) }}" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}
                    @include('web.employee.includes.personal-form', $employee)
                    <button type="submit" class="btn btn-submit btn-success">Update my info</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop


@section('scripts-footer')
<script>
        $('#civil_status').on('change', function(){
            if($(this).val() !== 'single') {
                $('#noDependentsContainer').css('display', 'flex');
            } else {
                $('#noDependentsContainer').css('display', 'none');
            }
        });
</script>
@stop
