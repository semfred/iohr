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
    <label for="name" class="col-md-2 col-form-label">Username</label>
    <div class="col-md-10">
        <input type="text" name="name" id="name" class="form-control" value="{{ isset($user) ? $user->name : old('name') }}">
    </div>
</div>

<div class="form-group row">
    <label for="email" class="col-md-2 col-form-label">Email</label>
    <div class="col-md-10">
        <input type="email" name="email" id="email" class="form-control" value="{{ isset($user) ? $user->email : old('email') }}"  {{ isset($user) ? 'disabled' : '' }}>
    </div>
</div>

@if(isset($user))

<div class="form-group row">
    <label for="password" class="col-md-2 col-form-label">Password</label>
    <div class="col-md-10">
        <input type="password" name="password" id="password" class="form-control">
    </div>
</div>

<div class="form-group row">
    <label for="password_confirmation" class="col-md-2 col-form-label">Confirm Password</label>
    <div class="col-md-10">
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
    </div>
</div>

@endif

<div class="form-group row">
    <label for="" class="col-md-2 col-form-label">Account Type</label>
    <div class="col-md-10">
        <select class="custom-select" name="type" >
            <option style="display:none;" selected disabled>Select Account Type</option>
            @foreach(getUserTypes() as $type)
                <option value="{{ strtolower($type) }}" {{ isset($user) ? strtolower($type) == $user->type ? 'selected' : '' : '' }}>{{ $type }}</option>
            @endforeach
        </select>
    </div>
</div>

{{-- <div class="form-group row">
    <label for="superuser" class="col-md-2 col-form-label"></label>
    <div class="col-md-10">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="superuser" id="superuser">
            <label class="custom-control-label" for="superuser">is Super User?</label>
        </div>
    </div>
</div> --}}
