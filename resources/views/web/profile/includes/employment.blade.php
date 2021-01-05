<div class="form-group row">
    <div class="col-md-3">
        Onboard Date:
    </div>
    <div class="col-md-9">
        <strong>{{ isset($employment) ? date_format(date_create($employment->onboard_date), 'Y-m-d') : '' }}</strong>
    </div>
</div>

<div class="form-group row" id="offboard_date_container" style="{{ isset($employment) ? ($employment->employed == 0) ? 'display: flex;' : 'display:none;' : 'display:flex;' }}">
    <label for="offboard_date" class="col-md-2 col-form-label">Offboard Date:</label>
    <div class="col-md-10">
        <input type="date" name="offboard_date" id="offboard_date" class="form-control" value="{{ isset($employment) ? date_format(date_create($employment->offboard_date), 'Y-m-d') : '' }}">
    </div>
</div>

<div class="form-group row">
    <div class="col-md-3">
        Position:
    </div>
    <div class="col-md-9">
        <strong>{{ isset($employment->position) ? $employment->position->name  : '' }}</strong>
    </div>
</div>

<div class="form-group row">
    <div class="col-md-3">
        Working Schedule:
    </div>
    <div class="col-md-9">
        <strong>{{ isset($employment) ? $employment->working_hrs == '1-10-m-f' ? getSchedule($employment->working_hrs) : 'N/A' : 'N/A' }}</strong>
    </div>
</div>

<div class="form-group row">
    <div class="col-md-3">
           Immediate Manager:
    </div>
    <div class="col-md-9">
        <strong>{{ isset($employment) ? isset($employment->immediateManager) ? $employment->immediateManager->name : 'No Immediate Manager Selected' : 'No Immediate Manager Selected' }}</strong>
    </div>
</div>

<div class="form-group row">
    <div class="col-md-3">
           Approving Manager:
    </div>
    <div class="col-md-9">
        <strong>{{ isset($employment) ? isset($employment->approvingManager) ? $employment->approvingManager->name : 'No Approving Manager Selected' : 'No Approving Manager Selected' }}</strong>
    </div>
</div>

