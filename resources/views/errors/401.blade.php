@extends('layouts.web.master')

@section('title')
Unauthorized Access
@stop

@section('content')

<div class="text-center">
  <div class="error mx-auto" data-text="404">401</div>
  <p class="lead text-gray-800 mb-5">You are unauthorized to access this page</p>
  <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
  <a href="/">&larr; Return home</a>
</div>

@stop
