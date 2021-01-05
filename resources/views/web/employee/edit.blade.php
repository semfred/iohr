@extends('layouts.web.master')

@section('title')
    Edit Employee {{ $employee->id }}
@stop

@section('content')
<ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-bottom:1rem;">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Personal</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Employment</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Leave Entitlement</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="password-tab" data-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="false">Change Password</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-body">
                                <form action="{{ route('web.employees.update', $employee) }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="PUT">
                                            <div class="row">
                                                <div class="col">
                                                        <h3>Personal Details</h3>
                                                </div>
                                            </div>
                                            @include('web.employee.includes.personal-form', $employee)
                                            <button type="submit" class="btn btn-success">Update</button>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
      <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                        <div class="card">
                            <div class="card-body">
                                    <form action="{{ route('web.employees.update.employment', $employee) }}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="PUT">
                                          <div class="row">
                                              <div class="col">
                                                      <h3>Employment Details</h3>
                                              </div>
                                          </div>
                                          @include('web.employee.includes.employment-form', ['employment' => $employee->employment, 'managers' => $managers])
                                          <hr>
                                          <div class="row">
                                              <div class="col">
                                                      <h3>Salary</h3>
                                              </div>
                                              <div class="col text-right">
                                                  {{-- <button class="btn btn-sm btn-primary">
                                                      Check Salary History
                                                  </button> --}}
                                              </div>
                                          </div>
                                          @include('web.employee.includes.salary-form', ['salary' => $employee->latestSalary()])
                                          <button type="submit" class="btn btn-success">Update</button>
                                      </form>
                            </div>
                        </div>
                </div>
            </div>
      </div>
  </div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
      <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-body">
                                <form action="{{ route('web.employees.update.entitlement', $employee) }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="row">
                                        <div class="col">
                                                <h3>Leave Entitlement Details</h3>
                                        </div>
                                    </div>
                                    @include('web.employee.includes.leave-form', ['leave' => $employee->entitlement])
                                    <button type="submit" class="btn btn-success">Update</button>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
      </div>
  </div>
  <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
    <div class="container-fluid">
          <div class="row">
              <div class="col-md-8 offset-md-2">
                  <div class="card">
                      <div class="card-body">

                                <div class="row">
                                      <div class="col">
                                              <h3>Change Password</h3>
                                      </div>
                                  </div>
                                  <form action="{{ route('web.users.update', $employee) }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="PUT">
                                    @include('web.users.includes.form', $user = $employee)
                                    <button class="btn btn-success">Update</button>
                                </form>
                      </div>
                  </div>
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
