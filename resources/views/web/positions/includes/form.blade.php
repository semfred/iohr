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
    <label for="name" class="col-md-2 col-form-label">Position Name</label>
    <div class="col-md-10">
        <input type="text" name="name" id="name" class="form-control" value="{{ isset($position) ? $position->name : '' }}">
    </div>
</div>

<div class="form-group row">
    <label for="mngr" class="col-md-2 col-form-label"></label>
    <div class="col-md-10">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="mngr" id="mngr" {{ isset($position) ? ($position->mngr) ? 'checked' : '' : '' }}>
                <label class="custom-control-label" for="mngr">is this a Managerial Position?</label>
            </div>
    </div>
</div>
