<div class="form-group row">
    <label for="amount" class="col-md-2 col-form-label">Monthly Gross Income</label>
    <div class="col-md-10">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="amount_group">₱</span>
            </div>
            <input type="number" min="0" step="0.5" name="amount" id="amount" class="form-control" value="{{ isset($salary) ? $salary->amount : '0' }}">
        </div>
    </div>
</div>

<div class="form-group row">
    <label for="effective_date" class="col-md-2 col-form-label">Effective Date</label>
    <div class="col-md-10">
        <input type="date" name="effective_date" id="effective_date" class="form-control" value="{{ isset($salary) ? date_format(date_create($salary->effective_date), 'Y-m-d') : '' }}">
    </div>
</div>

<div class="row">
    <div class="col">
        <h5>Allowances</h5>
    </div>
</div>

<div class="form-group row">
    <label for="allowance_rice" class="col-md-2 col-form-label">Rice</label>
    <div class="col-md-10">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="allowance_rice_group">₱</span>
            </div>
            <input type="number" min="0" step="0.5" name="allowance_rice" id="allowance_rice" class="form-control" value="{{ isset($salary) ? $salary->allowance_rice : '0' }}">
        </div>
    </div>
</div>

<div class="form-group row">
    <label for="allowance_transpo" class="col-md-2 col-form-label">Transportation</label>
    <div class="col-md-10">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="allowance_transpo_group">₱</span>
            </div>
            <input type="number" min="0" step="0.5" name="allowance_transpo" id="allowance_transpo" class="form-control" value="{{ isset($salary) ? $salary->allowance_transpo : '0' }}">
        </div>
    </div>
</div>

<div class="form-group row">
    <label for="allowance_laundry" class="col-md-2 col-form-label">Laundry</label>
    <div class="col-md-10">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="allowance_laundry_group">₱</span>
            </div>
            <input type="number" min="0" step="0.5" name="allowance_laundry" id="allowance_laundry" class="form-control" value="{{ isset($salary) ? $salary->allowance_laundry : '0' }}">
        </div>
    </div>
</div>

<div class="form-group row">
    <label for="allowance_other" class="col-md-2 col-form-label">Other</label>
    <div class="col-md-10">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="allowance_other_group">₱</span>
            </div>
            <input type="number" min="0" step="0.5" name="allowance_other" id="allowance_other" class="form-control" value="{{ isset($salary) ? $salary->allowance_other : '0' }}">
        </div>
    </div>
</div>
