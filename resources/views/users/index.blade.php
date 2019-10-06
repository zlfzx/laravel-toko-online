@extends('layouts.global')

@section('title', 'Users List')

@section('content')
    <form action="{{ route('users.index') }}">
        <div class="row">
            <div class="col-md-6">
                <input type="text" class="form-control" name="keyword" value="{{ Request::get('keyword') }}" placeholder="Filter by email">
            </div>
            <div class="col-md-6">
                <input {{ Request::get('status') == 'ACTIVE' ? 'checked' : '' }} type="radio" name="status" value="ACTIVE" id="active">
                <label for="active">Active</label>
                <input {{ Request::get('status') == 'INACTIVE' ? 'checked' : '' }} type="radio" name="status" value="INACTIVE" id="inactive">
                <label for="inactive">Inactive</label>
                <input type="submit" value="Filter" class="btn btn-primary">
            </div>
        </div>
    </form>
    <div class="row mb-3">
        <div class="col-md-12 text-right">
            <a href="{{ route('users.create') }}" class="btn btn-primary">Create User</a>
        </div>
    </div>
    @if(session('status'))
        <div class="alert alert-success">
        {{session('status')}}
        </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Avatar</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }} </td>
                    <td>
                        @if ($user->avatar)
                            <img src="{{ asset('storage/'.$user->avatar) }}" alt="" width="70px">
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        @if($user->status == 'ACTIVE')
                        <span class="badge badge-success">{{ $user->status }}</span>
                        @else
                        <span class="badge badge-danger">{{ $user->status }}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ url('/users/'.$user->id) }}" class="btn btn-primary btn-sm">Detail</a>
                        <a href="{{ url('/users/'.$user->id.'/edit') }}" class="btn btn-info text-white btn-sm">Edit</a>
                        <form onsubmit="return confirm('Delete this user permanently?')" action="{{ url('/users/'.$user->id) }}" class="d-inline" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Delete" class="btn btn-sm btn-danger">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="10">{{ $users->appends(Request::all())->links() }}</td>
            </tr>
        </tfoot>
    </table>
@endsection
