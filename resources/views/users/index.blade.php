@extends('layouts.global')

@section('title', 'Users List')

@section('content')
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
    </table>
@endsection
