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
    <label for="vacation" class="col-md-2 col-form-label">Vacation Leave Entitlement Count</label>
    <div class="col-md-10">
        <input type="number" name="vacation" id="vacation" class="form-control" value="{{ isset($leave) ? $leave->vacation : '' }}">
    </div>
</div>

<div class="form-group row">
    <label for="sick" class="col-md-2 col-form-label">Sick Leave Entitlement Count</label>
    <div class="col-md-10">
        <input type="number" name="sick" id="sick" class="form-control" value="{{ isset($leave) ? $leave->sick : '' }}">
    </div>
</div>

<div class="form-group row">
    <label for="year" class="col-md-2 col-form-label">Year Effective</label>
    <div class="col-md-10">
        <input type="text" name="year" id="year" class="form-control" value="{{ isset($leave) ? $leave->year : '' }}">
    </div>
</div>
