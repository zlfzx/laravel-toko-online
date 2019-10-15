@extends('layouts.global')
@section('title', 'Book List')
    
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('books.index') }}" method="post">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="keyword" value="{{ Request::get('keyword') }}" placeholder="Filter by title" class="form-control">
                            <div class="input-group-append">
                                <input type="submit" value="Filter" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            <a href="{{ route('books.index') }}" class="nav-link {{ Request::get('status') == NULL && Request::path() == 'books' ? 'active' : '' }}">All</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('books.index', ['status' => 'publish']) }}" class="nav-link {{ Request::get('status') == 'publish' ? 'active' : '' }}"></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('books.index', ['status' => 'draft']) }}" class="nav-link {{ Request::get('status') == 'draft' ? 'active' : '' }}">Draft</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('books.trash') }}" class="nav-link {{ Request::path() == 'books/trash' ? 'active' : '' }}">Trash</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12 text-right">
                    <a href="{{ route('books.create') }}" class="btn btn-primary">Create Book</a>
                </div>
            </div>
            @if (session('session'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Cover</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Status</th>
                        <th>Categories</th>
                        <th>Stock</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td>
                                @if ($book->cover)
                                    <img src="{{ asset('storage/'.$book->cover) }}" width="96px" alt="">
                                @else
                                    No Cover
                                @endif
                            </td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->status }}</td>
                            <td>
                                <ul class="pl-3">
                                    @foreach ($book->categories as $category)
                                        <li>{{ $category->name }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $book->stock }}</td>
                            <td>{{ $book->price }}</td>
                            <td>
                                <a href="{{ route('books.edit', [$book->id]) }}" class="btn btn-info btn-sm">Edit</a>
                                <form action="{{ route('books.restore', [$book->id]) }}" onsubmit="return confirm('Move book to trash?')" method="post" class="d-inline">
                                    @csrf
                                    <input type="submit" value="Restore" class="btn btn-success btn-sm">
                                </form>
                                <form action="{{ route('books.delete-permanent', [$book->id]) }}" onsubmit="return confirm('Delete this book permanently?')" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td>{{ $books->appends(Request::all())->links() }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
