@extends('layouts.web.master')

@section('title')
    Create Employee
@stop

@section('content')
<div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('web.employees.store') }}" method="POST">
                            {{ csrf_field() }}
                            @include('web.employee.includes.personal-form')
                            <button type="submit" class="btn btn-success">Create</button>
                            <a href="{{ URL::previous() }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
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

        $('#employed').on('change', function(){
            if(!$(this).prop('checked')) {
                $('#offboard_date_container').css('display', 'flex');
            } else {
                $('#offboard_date_container').css('display', 'none');
            }
        });
</script>
@stop
