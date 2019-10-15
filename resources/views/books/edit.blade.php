@extends('layouts.global')
@section('title', 'Edit Book')

@section('content')
    <div class="row">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ route('books.update', [$book->id]) }}" enctype="multipart/form-data" method="post" class="shadow-sm p-3 bg-white">
                @csrf
                @method('put')
                <label for="title">Title</label> <br>
                <input type="text" value="{{ $book->title }}" class="form-control" name="title" placeholder="Book title">
                <br>
                <label for="cover">Cover</label>
                <small class="text-muted">Current Cover</small><br>
                @if ($book->cover)
                    <img src="{{ asset('storage/'.$book->cover) }}" width="96px" alt="">
                @endif
                <br><br>
                <input type="file" class="form-control" name="cover">
                <small class="text-muted">Kosongkan jika tidak ingin mengubah cover</small>
                <br><br>

                <label for="slug">Slug</label>
                <input type="text" name="slug" value="{{ $book->slug }}" placeholder="enter a slug" class="form-control">

                <label for="description">Description</label><br>
                <textarea name="description" id="description" class="form-control" placeholder="Give a description about this book">
                    {{ $book->description }}
                </textarea>
                <br>
                <label for="categories">categories</label>
                <select name="categories[]" multiple id="categories" class="form-control"></select>
                <br><br>
                <label for="stock">Stock</label><br>
                <input type="number" value="{{ $book->stock }}" class="form-control" id="stock" name="stock" min=0 value=0>
                <br>
                <label for="author">Author</label><br>
                <input type="text" value="{{ $book->author }}" class="form-control" name="author" id="author" placeholder="Book author">
                <br>
                <label for="publisher">Publisher</label> <br>
                <input type="text" value="{{ $book->publisher }}" class="form-control" id="publisher" name="publisher" placeholder="Book publisher">
                <br>
                <label for="Price">Price</label> <br>
                <input type="number" value="{{ $book->price }}" class="form-control" name="price" id="price" placeholder="Book price">
                <br>

                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="PUBLISH" {{ $book->status == 'PUBLISH' ? 'selected' : '' }}>PUBLISH</option>
                    <option value="DRAFT" {{ $book->status == 'DRAFT' ? 'selected' : '' }}>DRAFT</option>
                </select>
                <br>
                <button class="btn btn-primary" name="save_action" value="PUBLISH">Update</button>
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
        });
        var categories = {!! $book->categories !!}
        categories.forEach(function(cat){
            var option = new Option(cat.name, cat.id, true, true);
            $('#categories').append(option).trigger('change');
        });
    </script>
@endsection
