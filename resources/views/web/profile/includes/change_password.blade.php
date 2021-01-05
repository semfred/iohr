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
    <label for="password" class="col-md-2 col-form-label">{{ !Auth::user()->password_changed ? 'New ' : ''  }}Password</label>
    <div class="col-md-10">
        <input type="password" name="password" id="password" class="form-control">
    </div>
</div>

<div class="form-group row">
    <label for="password_confirmation" class="col-md-2 col-form-label">Confirm {{ !Auth::user()->password_changed ? 'New ' : ''  }}Password</label>
    <div class="col-md-10">
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
    </div>
</div>
