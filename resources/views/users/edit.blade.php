@extends('layouts.global')

@section('title', 'Edit User')

@section('content')
    <div class="col-md-8">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('users.update', ['id' => $user->id]) }}" enctype="multipart/form-data" class="bg-white shadow-sm p-3" method="post">
            @csrf
            @method('put')

            <label for="name">Name</label>
            <input value="{{ old('name') ? old('name') : $user->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Full Name" type="text" name="name" id="name"/>
            <br>

            <label for="username">Username</label>
            <input value="{{$user->username}}" disabled class="form-control" placeholder="username" type="text" name="username" id="username"/>
            <br>
            <label for="">Status</label>
            <br/>
            <input {{$user->status == "ACTIVE" ? "checked" : ""}} value="ACTIVE" type="radio" class="form-control" id="active" name="status">
            <label for="active">Active</label>
            <input {{$user->status == "INACTIVE" ? "checked" : ""}} value="INACTIVE" type="radio" class="form-control" id="inactive" name="status">
            <label for="inactive">Inactive</label>
            <br><br>

            <label for="">Roles</label>
            <br>
            <input @error('roles') class="is-invalid" @enderror type="checkbox" {{in_array("ADMIN", json_decode($user->roles)) ? "checked" : ""}} name="roles[]" id="ADMIN" value="ADMIN">
            <label for="ADMIN">Administrator</label>
            <input @error('roles') class="is-invalid" @enderror type="checkbox" {{in_array("STAFF", json_decode($user->roles)) ? "checked" : ""}} name="roles[]" id="STAFF" value="STAFF">
            <label for="STAFF">Staff</label>
            <input @error('roles') class="is-invalid" @enderror type="checkbox" {{in_array("CUSTOMER", json_decode($user->roles)) ? "checked" : ""}} name="roles[]" id="CUSTOMER" value="CUSTOMER">
            <label for="CUSTOMER">Customer</label>
            @error('roles')
                <div class="invalid-feedback">
                    {[ $errors->first->roles ]}
                </div>
            @enderror
            <br>
            <br>
            <label for="phone">Phone number</label>
            <br>
            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{$user->phone}}">
            <div class="invalid-feedback">
                {{ $errors->first('phone') }}
            </div>
            <br>
            <label for="address">Address</label>
            <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror">{{$user->address}}
            </textarea>
            <div class="invalid-feedback">
                {{ $errors->first('address') }}
            </div>
            <br>
            <label for="avatar">Avatar image</label>
            <br>
            Current avatar: <br>
            @if($user->avatar)
            <img src="{{asset('storage/'.$user->avatar)}}" width="120px" />
            <br>
            @else
            No avatar
            @endif
            <br>
            <input id="avatar" name="avatar" type="file" class="form-control">
            <small class="text-muted">Kosongkan jika tidak ingin mengubah avatar</small>

            <hr
            class="my-3">

            <label for="email">Email</label>
            <input value="{{$user->email}}" disabled class="form-control" placeholder="user@mail.com" type="text" name="email" id="email"/>
            <br>

            <input
            class="btn btn-primary"
            type="submit"
            value="Save"/>
        </form>
    </div>
@endsection
