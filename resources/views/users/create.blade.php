@extends('layouts.global')

@section('title', 'Create User')

@section('content')
    <div class="col-md-8">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('users.store') }}" class="bg-white shadow-sm p-3" enctype="multipart/form-data" method="post">
            @csrf
            <label for="name">Name</label>
            <input class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}" placeholder="Full Name" type="text" name="name" id="name"/>
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
            <br>
            <label for="username">Username</label>
            <input class="form-control {{ $errors->first('username') ? 'is-invalid' : '' }}" value="{{ old('username') }}" placeholder="username" type="text" name="username" id="username"/>
            <div class="invalid-feedback">
                {{ $errors->first('username') }}
            </div>
            <br>

            <label for="">Roles</label>
            <br>
            <input type="checkbox" @error('roles') class="is-invalid" @enderror name="roles[]" id="ADMIN" value="ADMIN">
            <label for="ADMIN">Administrator</label>
            <input type="checkbox" @error('roles') class="is-invalid" @enderror name="roles[]" id="STAFF" value="STAFF">
            <label for="STAFF">Staff</label>
            <input type="checkbox" @error('roles') class="is-invalid" @enderror name="roles[]" id="CUSTOMER" value="CUSTOMER">
            <label for="CUSTOMER">Customer</label>
            <div class="invalid-feedback">
                {{ $errors->first('roles') }}
            </div>
            <br>
            <br>
            <label for="phone">Phone number</label>
            <br>
            <input type="text" name="phone" value="{{ old('phone') }}" class="form-control {{ $errors->first('phone') ? 'is-invalid' : '' }}">
            <div class="invalid-feedback">
                {{ $errors->first('phone') }}
            </div>
            <br>
            <label for="address">Address</label>
            <textarea name="address" id="address" class="form-control {{ $errors->first('address') ? 'is-invalid' : '' }}">{{ old('address') }}</textarea>
            <div class="invalid-feedback">
                {{ $errors->first('address') }}
            </div>
            <br>
            <label for="avatar">Avatar image</label>
            <br>
            <input id="avatar" name="avatar" type="file" class="form-control @error('avatar') is-invalid @enderror">
            <div class="invalid-feedback">
                {{ $errors->first('avatar') }}
            </div>
            <hr class="my-4">
            <label for="email">Email</label>
            <input class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" placeholder="user@mail.com" type="email" name="email" id="email"/>
            <div class="invalid-feedback">
                {{ $errors->first('email') }}
            </div>
            <br>
            <label for="password">Password</label>
            <input class="form-control {{ $errors->first('password') ? 'is-invalid' : '' }}" value="{{ old('password') }}" placeholder="password" type="password" name="password" id="password"/>
            <div class="invalid-feedback">
                {{ $errors->first('password') }}
            </div>
            <br>
            <label for="password_confirmation">Password Confirmation</label>
            <input class="form-control {{ $errors->first('password_confirmation') ? 'is-invalid' : '' }}" value="{{ old('password_confirmation') }}" placeholder="password confirmation" type="password" name="password_confirmation" id="password_confirmation"/>
            <div class="invalid-feedback">
                {{ $errors->first('password_confirmation') }}
            </div>
            <br>
            <input class="btn btn-primary" type="submit" value="Save"/>
        </form>
    </div>
@endsection
