@extends('layouts.layout')

@section('title', 'Books')

@section('content')

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
@endpush
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0">Books</h3>
                    <a href="{{ url('books/create') }}" class="btn btn-success btn-md float-right">Add New Book</a>
                </div>
                @if($books->isEmpty())
                <p class="text-center text-primary">No Book Uploaded yet.</p>
                @else<div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">SN</th>
                                <th scope="col">Cover</th>
                                <th scope="col">Title</th>
                                <th scope="col">Author</th>
                                <th scope="col">Publisher</th>
                                <th scope="col">Date Published</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Last Update</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach($books as $book)
                            <tr>
                                <th>{{ $count++ }}</th>
                                <th scope="row">
                                    <div class="media align-items-center">
                                        <a href="#" class="avatar rounded-circle mr-3">
                                            <img alt="{{ $book->title }}" src="{{ $book->get_front_cover() }}">
                                        </a>
                                    </div>
                                </th>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->publisher }}</td>
                                <td> {{ date('l jS F Y', strtotime($book->date_published)) }}</td>
                                <td>{{ $book->created_at->diffForHumans() }}</td>
                                <td>{{ $book->updated_at->diffForHumans() }}</td>
                                <td></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
    @include('layouts.partials.footer')
</div>
@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script>
    $('document').ready(function() {
        $('table').dataTable();
    });
</script>
@endpush
@endsection
