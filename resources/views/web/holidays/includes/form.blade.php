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
    <label for="name" class="col-md-2 col-form-label">Holiday Name</label>
    <div class="col-md-10">
        <input type="text" name="name" id="name" class="form-control" value="{{ isset($holiday) ? $holiday->name : '' }}">
    </div>
</div>

<div class="form-group row">
    <label for="observance" class="col-md-2 col-form-label">Observance</label>
    <div class="col-md-10">
        <input type="date" name="observance" id="observance" class="form-control" value="{{ isset($holiday) ? date('m/d/Y', strtotime($holiday->observance)) : '' }}">
    </div>
</div>

<div class="form-group row">
    <label for="active" class="col-md-2 col-form-label"></label>
    <div class="col-md-10">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="active" id="active" {{ isset($holiday) ? ($holiday->active) ? 'checked' : '' : '' }}>
                <label class="custom-control-label" for="active">Active Holiday?</label>
            </div>
    </div>
</div>
