@extends('layouts.global')
@section('title', 'Detail Category')

@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <label for="">Category Name</label><br>
                {{ $category->name }}
                <br><br>

                <label for="">Category Slug</label><br>
                {{ $category->slug}}
                <br><br>

                <label for="">Category Image</label><br>
                @if ($category->image)
                    <img src="{{ asset('storage/'.$category->image) }}" width="120px" alt="">
                @endif
            </div>
        </div>
    </div>
@endsection