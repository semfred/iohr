@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    <label for="status_note">Notes:</label>
    <textarea class="form-control" id="status_note" name="status_note" rows="5" style="resize: none;">{{ isset($leave) ? $leave->status_note : '' }}</textarea>
</div>

<div class="form-group row">
    <label for="attachment" class="col-md-2 col-form-label">Attach File</label>
    <div class="col-md-10">
        <div class="custom-file">
            <input type="file" class="custom-file-input" name="attachment" id="attachment">
            <label class="custom-file-label" for="attachment">Choose file</label>
        </div>
    </div>
</div>
