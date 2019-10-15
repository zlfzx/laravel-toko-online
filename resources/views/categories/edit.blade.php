@extends('layouts.global')
@section('title', 'Edit Category')

@section('content')
    <div class="col-md-8">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('categories.update', [$category->id]) }}" method="post" enctype="multipart/form-data" class="bg-white shadow-sm p-3">
            @csrf
            @method('put')
            <label for="name">Category Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ? old('name') : $category->name }}" name="name" id="name">
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
            <br>

            <label for="slug">Category Slug</label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug" value="{{ old('slug') ? old('slug') : $category->slug }}">
            <div class="invalid-feedback">
                {{ $errors->first('slug') }}
            </div>
            <br>

            @if ($category->image)
                <span>Current Image</span><br>
                <img src="{{ asset('storage/'.$category->image) }}" alt="" width="120px">
            @else
                No Image
            @endif
            <br><br>
            <label for="image">Category Image</label>
            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
            <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
            <div class="invalid-feedback">
                {{ $errors->first('image') }}
            </div>
            <br><br>
    
            <input type="submit" value="Save" class="btn btn-primary">
        </form>
    </div>
@endsection