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
    <label for="type" class="col-md-2 col-form-label"></label>
    <div class="col-md-10">
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="vacation" required name="type" class="custom-control-input" value="vacation">
            <label class="custom-control-label" for="vacation">Vacation</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="sick" required name="type" class="custom-control-input" value="sick">
            <label class="custom-control-label" for="sick">Sick</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="other" required name="type" class="custom-control-input" value="other">
            <label class="custom-control-label" for="other">Other</label>
        </div>
    </div>
</div>

<div class="form-group row" id="other_specify_container" style="display:none;">
    <label for="other_specify" class="col-md-2 col-form-label">if Other please specify</label>
    <div class="col-md-10">
        <input type="text" name="other_specify" id="other_specify" class="form-control">
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="form-group row">
            <label for="startDate" class="col-md-4 col-form-label">Start Date:</label>
            <div class="col-md-8">
                <input type="date" required name="startDate" id="startDate" class="form-control">
                <div id="dateContainer"></div>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="form-group row">
            <label for="toDate" class="col-md-4 col-form-label">To Date:</label>
            <div class="col-md-8">
                <input type="date" required name="toDate" id="toDate" class="form-control">
            </div>
        </div>
    </div>
</div>

<div class="form-group row">
    <label for="note" class="col-md-2 col-form-label">Note:</label>
    <div class="col-md-10">
        <textarea name="note" id="note" rows="5" style="resize: none;" class="form-control"></textarea>
    </div>
</div>

{{-- <div class="form-group row">
    <label for="attachment" class="col-md-2 col-form-label">Attach File</label>
    <div class="col-md-10">
        <div class="custom-file">
            <input type="file" class="custom-file-input" name="attachment" id="attachment">
            <label class="custom-file-label" for="attachment">Choose file</label>
        </div>
    </div>
</div> --}}

@section('scripts-footer')
<script src="{{ asset('js/web/requests.js') }}" defer></script>
<script>
    $(document).ready(function(){
        $('input[name=type]').on('change', function(){
            if($('#other').prop('checked')) {
                $('#other_specify_container').css('display', 'flex');
            } else {
                $('#other_specify_container').css('display', 'none');
            }
        })
    });
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
@stop
