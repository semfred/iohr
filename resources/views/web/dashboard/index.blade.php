@extends('layouts.web.master')

@section('content')
    <div class="row">
        <div class="col-md-4">

                <div class="accordion" id="accordionExample">
                        <div class="card">
                          <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                Out for Today
                            </h5>
                          </div>

                          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                    <ul class="list-unstyled">
                                        @foreach($dates['today'] as $i => $out)
                                            <li class="media {{ !$loop->last ? 'mb-3' : '' }}">
                                                    <img class="align-self-center mr-3" src="https://via.placeholder.com/64" alt="Generic placeholder image">
                                                <div class="media-body">
                                                        <h5 class="mt-0 mb-1">{{ $out->employee->name }}</h5>
                                                        <small>
                                                            @if($out->type == 'vacation')
                                                                <i class="fas fa-glass-cheers text-gray-300"></i>
                                                            @elseif($out->type == 'sick')
                                                                <i class="fas fa-file-medical text-gray-300"></i>
                                                            @else

                                                            @endif
                                                            &nbsp;
                                                            <em>{{ $out->from_date->format('M d, Y') }} - {{ $out->to_date->format('M d, Y') }}</em>
                                                        </small>
                                                </div>
                                            </li>
                                        @endforeach
                                        @if(!count($dates['today']))
                                            <li class="media">
                                                <em>No one is out for Today</em>
                                            </li>
                                        @endif
                                    </ul>
                            </div>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                Out for Tomorrow
                            </h5>
                          </div>
                          <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                    <ul class="list-unstyled">
                                        @foreach($dates['tomorrow'] as $i => $out)
                                            <li class="media {{ !$loop->last ? 'mb-3' : '' }}">
                                                <img class="align-self-center mr-3" src="https://via.placeholder.com/64" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h5 class="mt-0 mb-1">{{ $out->employee->name }}</h5>
                                                    <small>
                                                        @if($out->type == 'vacation')
                                                            <i class="fas fa-glass-cheers text-gray-300"></i>
                                                        @elseif($out->type == 'sick')
                                                            <i class="fas fa-file-medical text-gray-300"></i>
                                                        @else

                                                        @endif
                                                        &nbsp;
                                                        <em>{{ $out->from_date->format('M d, Y') }} - {{ $out->to_date->format('M d, Y') }}</em>
                                                    </small>
                                                </div>
                                            </li>
                                        @endforeach
                                        @if(!count($dates['tomorrow']))
                                            <li class="media">
                                                <em>No one is out for Tomorrow</em>
                                            </li>
                                        @endif
                                    </ul>
                            </div>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                                Out This Week
                            </h5>
                          </div>
                          <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordionExample">
                            <div class="card-body">
                                @foreach($dates['week'] as $i => $out)
                                    <li class="media {{ !$loop->last ? 'mb-3' : '' }}">
                                        <img class="align-self-center mr-3" src="https://via.placeholder.com/64" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <h5 class="mt-0 mb-1">{{ $out->employee->name }}</h5>
                                            <small>
                                                    @if($out->type == 'vacation')
                                                        <i class="fas fa-glass-cheers text-gray-300"></i>
                                                    @elseif($out->type == 'sick')
                                                        <i class="fas fa-file-medical text-gray-300"></i>
                                                    @else

                                                    @endif
                                                    &nbsp;
                                                    <em>{{ $out->from_date->format('M d, Y') }} - {{ $out->to_date->format('M d, Y') }}</em>
                                                </small>
                                        </div>
                                    </li>
                                @endforeach
                                @if(!count($dates['week']))
                                    <li class="media">
                                        <em>No one is out this Week</em>
                                    </li>
                                @endif
                            </div>
                          </div>
                        </div>
                      </div>

        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                        <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div> --}}
@stop

@section('scripts-footer')
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script src="{{ asset('js/web/dashboard.js') }}" defer></script>
<script>

</script>
@stop
