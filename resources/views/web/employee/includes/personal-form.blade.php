@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group row">
    <label for="name" class="col-md-2 col-form-label">Name <span class="text-danger">*</span></label>
    <div class="col-md-10">
        <div class="row">
            <div class="col">
                    <input type="text" name="fname" id="fname" class="form-control" required placeholder="First Name" value="{{ isset($employee) ? $employee->fname : old('fname') }}">
            </div>
            <div class="col">
                    <input type="text" name="mname" id="mname" class="form-control" placeholder="Middle Name" value="{{ isset($employee) ? $employee->mname : old('mname') }}">
            </div>
            <div class="col">
                    <input type="text" name="lname" id="lname" class="form-control" required placeholder="Last Name" value="{{ isset($employee) ? $employee->lname : old('lname') }}">
            </div>
        </div>
    </div>
</div>

<div class="form-group row">
    <label for="email" class="col-md-2 col-form-label">Email <span class="text-danger">*</span></label>
    <div class="col-md-10">
        <input type="email" {{ (Request::segment(2) == 'profile') ? 'readonly' : '' }} name="email" required id="email" class="form-control" placeholder="someone@example.com" value="{{ isset($employee) ? $employee->email : old('email') }}">
        {{-- @if(isset($employee))
            @if(!$employee->user->email_verified_at)
                <small id="emailHelp" class="form-text"><span class="text-danger">User not yet verified.</span> <a href="{{ route('web.employees.resendverification', $employee) }}">Resend Verification Email</a></small>
            @endif
        @endif --}}
    </div>
</div>

<div class="form-group row">
    <label for="birthday" class="col-md-2 col-form-label">Birthday <span class="text-danger">*</span></label>
    <div class="col-md-10">
        <input type="date" name="birthday" class="form-control" required id="birthday" value="{{ isset($employee) ? date_format(date_create($employee->birthday), 'Y-m-d') : old('birthday') }}">
    </div>
</div>

<div class="form-group row">
    <label for="gender" class="col-md-2 col-form-label">Gender <span class="text-danger">*</span></label>
    <div class="col-md-10">
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" name="gender" id="genderMale" class="custom-control-input" {{ isset($employee) ? $employee->gender == 'male' ? 'checked' : old('gender') == 'male' ? 'checked' : '' : ''  }} required value="male">
            <label for="genderMale" class="custom-control-label">Male</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" name="gender" id="genderFemale" class="custom-control-input" {{ isset($employee) ? $employee->gender == 'female' ? 'checked' : old('gender') == 'female' ? 'checked' : '' : ''  }} required value="female">
            <label for="genderFemale" class="custom-control-label">Female</label>
        </div>
    </div>
</div>

<div class="form-group row">
    <label for="contact_no" class="col-md-2 col-form-label">Contact Number</label>
    <div class="col-md-10">
        <input type="tel" name="contact_no" id="contact_no" placeholder="+(000) 000-000" class="form-control" value="{{ isset($employee) ? $employee->contact_no : old('contact_no') }}">
    </div>
</div>

<div class="form-group row">
    <label for="civil_status" class="col-md-2 col-form-label">Civil Status <span class="text-danger">*</span></label>
    <div class="col-md-10">
        <select name="civil_status" required id="civil_status" class="custom-select">
            <option value="" selected disabled style="display:none;">Select Civil Status</option>
            <option {{ isset($employee) ? $employee->civil_status == 'single' ? 'selected' : old('civil_status') == 'single' ? 'selected' : '' : ''  }} value="single">Single</option>
            <option {{ isset($employee) ? $employee->civil_status == 'married' ? 'selected' : old('civil_status') == 'married' ? 'selected' : '' : ''  }} value="married">Married</option>
            <option {{ isset($employee) ? $employee->civil_status == 'single_parent' ? 'selected' : old('civil_status') == 'single_parent' ? 'selected' : '' : ''  }} value="single_parent">Single Parent</option>
        </select>
    </div>
</div>

<div class="form-group row" id="noDependentsContainer" style="{{ isset($employee) ? ($employee->civil_status !== 'single') ? 'display: flex;' : 'display:none;' : 'display:none;' }}">
    <label for="noDependents" class="col-md-2 col-form-label">No. of Dependents (If Applicalble)</label>
    <div class="col-md-10">
        <input type="number" name="noDependents" id="noDependents" min="0" class="form-control" value="{{ isset($employee) ? $employee->noDependents : old('noDependents') }}">
    </div>
</div>

<div class="form-group row">
    <label for="tin_no" class="col-md-2 col-form-label">Tin No.</label>
    <div class="col-md-10">
        <input type="text" name="tin_no" id="tin_no" class="form-control" placeholder="000-000-000-00000" value="{{ isset($employee) ? $employee->tin_no : old('tin_no') }}">
    </div>
</div>

<div class="form-group row">
    <label for="sss_no" class="col-md-2 col-form-label">SSS No.</label>
    <div class="col-md-10">
        <input type="text" name="sss_no" id="sss_no" class="form-control" placeholder="00-0000000-0" value="{{ isset($employee) ? $employee->sss_no : old('sss_no') }}">
    </div>
</div>

<div class="form-group row">
    <label for="philhealth_no" class="col-md-2 col-form-label">Philhealth No.</label>
    <div class="col-md-10">
        <input type="text" name="philhealth_no" id="philhealth_no" class="form-control" placeholder="00-000000000-0" value="{{ isset($employee) ? $employee->philhealth_no : old('philhealth_no') }}">
    </div>
</div>

<div class="form-group row">
    <label for="pagibig_no" class="col-md-2 col-form-label">PAGIBIG No.</label>
    <div class="col-md-10">
        <input type="text" name="pagibig_no" id="pagibig_no" class="form-control" placeholder="0000-0000-0000" value="{{ isset($employee) ? $employee->pagibig_no : old('pagibig_no') }}">
    </div>
</div>
