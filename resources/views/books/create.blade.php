@extends('layouts.global')
@section('title', 'Create Book')

@section('content')
    <div class="row">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ route('books.store') }}" enctype="multipart/form-data" method="post" class="shadow-sm p-3 bg-white">
                @csrf
                <label for="title">Title</label> <br>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Book title" value="{{ old('title') }}">
                <div class="invalid-feedback">
                    {{ $errors->first('title' )}}
                </div>
                <br>
                <label for="cover">Cover</label>
                <input type="file" class="form-control @error('cover') is-invalid @enderror" name="cover" value="{{ old('cover') }}">
                <div class="invalid-feedback">
                    {{ $errors->first('cover') }}
                </div>
                <br>
                <label for="description">Description</label><br>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" placeholder="Give a description about this book">{{ old('description') }}</textarea>
                <div class="invalid-feedback">
                    {{ $errors->first('description') }}
                </div>
                <br>
                <label for="categories">categories</label>
                <select name="categories[]" multiple id="categories" class="form-control"></select>
                <br><br>
                <label for="stock">Stock</label><br>
                <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" min=0 value="{{ old('stock') }}">
                <div class="invalid-feedback">
                    {{ $errors->first('stock') }}
                </div>
                <br>
                <label for="author">Author</label><br>
                <input type="text" class="form-control @error('author') is-invalid @enderror" name="author" id="author" placeholder="Book author" value="{{ old('author') }}">
                <div class="invalid-feedback">
                    {{ $errors->first('author') }}
                </div>
                <br>
                <label for="publisher">Publisher</label> <br>
                <input type="text" class="form-control @error('publisher') is-invalid @enderror" id="publisher" name="publisher" placeholder="Book publisher" value="{{ old('publisher') }}">
                <div class="invalid-feedback">
                    {{ $errors->first('publisher') }}
                </div>
                <br>
                <label for="Price">Price</label> <br>
                <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" id="price" placeholder="Book price" value="{{ old('price') }}">
                <div class="invalid-feedback">
                    {{ $errors->first('price') }}
                </div>
                <br>
                <button class="btn btn-primary" name="save_action" value="PUBLISH">Publish</button>
                <button class="btn btn-secondary" name="save_action" value="DRAFT">Save as draft</button>
            </form>
        </div>
    </div>
@endsection

@section('footer-script')
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script>
        $('#categories').select2({
            ajax: {
                url: '{{ url('ajax/categories/search') }}',
                processResults: function(data){
                    return {
                        results : data.map(function(item){
                            return {id: item.id, text: item.name}
                        })
                    }
                }
            }
        })
    </script>
@endsection
