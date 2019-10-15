@extends('layouts.global')
@section('title', 'Create Category')

@section('content')
    <div class="col-md-8">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data" class="bg-white shadow-sm p-3">
            @csrf
            <label for="name">Category Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name">
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
            <br>
    
            <label for="image">Category Image</label>
            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
            <div class="invalid-feedback">
                {{ $errors->first('image') }}
            </div>
            <br>
    
            <input type="submit" value="Save" class="btn btn-primary">
        </form>
    </div>
@endsection