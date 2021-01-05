@extends('layouts.web.master')

@section('title')
Users
@stop

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col"><h2>Users</h2></div>
                    <div class="col text-right">
                        <a href="{{ route('web.users.create') }}" class="btn btn-sm btn-success">Create User</a>
                    </div>
                </div>
                {{-- <table id="users-table" class="table table-condensed">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                    </tr>
                    </thead>
                </table> --}}

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Email</th>
                            <th scope="col">Name</th>
                            <th scope="col">Admin</th>
                            <th scope="col">Verified</th>
                            <th scope="col"></th>
                            </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $i => $user)
                            <tr class="{{ Auth::user()->id == $user->id ? 'table-success' : '' }}">
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->employee_info ? $user->employee_info->name : '' }}</td>
                                <td>{{ $user->superuser ? 'Yes' : 'No' }}</td>
                                <td>{!! $user->email_verified_at ? '<span class="text-success">Verified</span>' : '<span class="text-danger">Not yet Verified</span>' !!}</td>
                                <td class="text-center">
                                    <a href="{{ route('web.users.edit', $user) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                    <button data-id="deleteUser{{ $user->id }}" class="btn btn-delete btn-sm btn-danger"><i class="fas fa-times"></i></button>
                                </td>
                            </tr>
                            <form id="deleteUser{{ $user->id }}" action="{{ route('web.users.destroy', $user) }}" method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                {{ csrf_field() }}
                            </form>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts-footer')
<script>
    {{-- $(function() {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("web.users.index") }}'
        });
    }); --}}
</script>
@stop
