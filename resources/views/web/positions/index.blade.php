@extends('layouts.web.master')

@section('title')
Employment Positions
@stop

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col"><h2>Positions</h2></div>
                    <div class="col text-right">
                        <a href="{{ route('web.positions.create') }}" class="btn btn-sm btn-success">Create Position</a>
                    </div>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Pos ID</th>
                            <th scope="col">Position</th>
                            <th scope="col">Managerial</th>
                            <th scope="col">Employee Count</th>
                            <th scope="col"></th>
                            </tr>
                    </thead>
                    <tbody>
                        @foreach($positions as $i => $position)
                            <tr>
                                <th scope="row">{{ $position->id }}</th>
                                <td>{{ $position->name }}</td>
                                <td>{{ $position->mngr ? 'Yes' : 'No' }}</td>
                                <td>{{ $position->employees->count() }}</td>
                                <td class="text-center">
                                    <a href="{{ route('web.positions.edit', $position) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                    <button data-id="deletePosition{{ $position->id }}" class="btn btn-delete btn-sm btn-danger"><i class="fas fa-times"></i></button>
                                </td>
                            </tr>
                            <form id="deletePosition{{ $position->id }}" action="{{ route('web.positions.destroy', $position) }}" method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                {{ csrf_field() }}
                            </form>
                        @endforeach
                    </tbody>
                </table>

                {{ $positions->links() }}

            </div>
        </div>
    </div>
</div>
@stop
