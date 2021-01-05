@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(\Auth::user()->isAdmin() || \Auth::user()->superuser)

<div class="form-group row">
        <div class="col-md-2"></div>
        <div class="col-md-10">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" name="employed" class="custom-control-input" {{ isset($employment) ? ($employment->employed == 1) ? 'checked' : '' : '' }} id="employed">
                <label class="custom-control-label" for="employed">Onboard?</label>
            </div>
        </div>
    </div>

<div class="form-group row">
        <div class="col-md-2"></div>
        <div class="col-md-10">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" name="is_permanent" class="custom-control-input" {{ isset($employment) ? ($employment->is_permanent == 1) ? 'checked' : '' : '' }} id="is_permanent">
                <label class="custom-control-label" for="is_permanent">Regular?</label>
            </div>
        </div>
    </div>

<div class="form-group row">
    <label for="onboard_date" class="col-md-2 col-form-label">Onboard Date</label>
    <div class="col-md-10">
        <input type="date" name="onboard_date" id="onboard_date" class="form-control" value="{{ isset($employment) ? date_format(date_create($employment->onboard_date), 'Y-m-d') : '' }}">
    </div>
</div>

<div class="form-group row" id="offboard_date_container" style="{{ isset($employment) ? ($employment->employed == 0) ? 'display: flex;' : 'display:none;' : 'display:flex;' }}">
    <label for="offboard_date" class="col-md-2 col-form-label">Offboard Date</label>
    <div class="col-md-10">
        <input type="date" name="offboard_date" id="offboard_date" class="form-control" value="{{ isset($employment) ? date_format(date_create($employment->offboard_date), 'Y-m-d') : '' }}">
    </div>
</div>

@endif

<div class="form-group row">
    <label for="position_id" class="col-md-2 col-form-label">Position</label>
    <div class="col-md-10">
        <select name="position_id" id="position_id" class="custom-select">
            <option value="" selected disabled style="display:none;">Select Position</option>
            @foreach(\App\Position::all() as $i => $position)
                <option {{ isset($employment) ? $employment->position_id == $position->id ? 'selected' : '' : '' }} value="{{ $position->id }}">{{ $position->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="working_hrs" class="col-md-2 col-form-label">Working Schedule</label>
    <div class="col-md-10">
        <select name="working_hrs" id="working_hrs" class="form-control">
                <option value="" selected disabled style="display:none;">Select Working Schedule</option>
                <option {{ isset($employment) ? $employment->working_hrs == '1-10-m-f' ? 'selected' : '' : '' }} value="1-10-m-f">Monday to Friday, 1:00pm - 10:00pm</option>
                <option {{ isset($employment) ? $employment->working_hrs == '2-11-m-f' ? 'selected' : '' : '' }} value="2-11-m-f">Monday to Friday, 2:00pm - 10:00pm</option>
                <option {{ isset($employment) ? $employment->working_hrs == '330-1230-m-f' ? 'selected' : '' : '' }} value="330-1230-m-f">Monday to Friday, 3:30pm - 12:30pm</option>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="immediate_mngr" class="col-md-2 col-form-label">Immediate Manager</label>
    <div class="col-md-10">
        <select name="immediate_mngr" id="immediate_mngr" class="form-control">
            <option value="" selected disabled style="display:none;">Select Immediate Manager</option>
            @foreach($managers as $i => $position)
                @if(Auth::user()->id !== $position->id)
                    <option {{ isset($employment) ? $employment->immediate_mngr == $position->id ? 'selected' : '' : '' }} value="{{ $position->id }}">{{ $position->name }}</option>
                @endif
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="approving_mngr" class="col-md-2 col-form-label">Approving Manager</label>
    <div class="col-md-10">
        <select name="approving_mngr" id="approving_mngr" class="form-control">
            <option value="" selected disabled style="display:none;">Select Approving Manager</option>
            @foreach($managers as $i => $position)
                @if(Auth::user()->id !== $position->id)
                    <option {{ isset($employment) ? $employment->approving_mngr == $position->id ? 'selected' : '' : '' }} value="{{ $position->id }}">{{ $position->name }}</option>
                @endif
            @endforeach
        </select>
    </div>
</div>

