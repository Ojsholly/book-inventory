@extends('layouts.layout')

@section('title', ' Archives')

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
                    <h3 class="mb-0">Archived Books</h3>
                    <div class="col-md-3 float-right">
                        <a href="{{ url('books/archive') }}" class="btn btn-warning btn-md float-right">Archived
                            Books</a>
                    </div>
                    <div class="col-md-3 float-right">
                        <a href="{{ url('books/create') }}" class="btn btn-success btn-md float-right">Add New Book</a>
                    </div>
                </div>
                @if($books->isEmpty())
                <p class="text-center text-primary">No Book Archived yet.</p>
                @else
                <div class="table-responsive">
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
                                <th scope="col">Date Archived</th>
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
                                <td> {{ date('l jS F Y', strtotime($book->date_published)) }} </td>
                                <td>{{ $book->created_at->diffForHumans() }}</td>
                                <td>{{ $book->updated_at->diffForHumans() }}</td>
                                <td>{{ $book->deleted_at->diffForHumans() }}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#restore-{{ $book->uuid }}"><i
                                                    class="ni ni-archive-2 text-primary"></i>Restore Book</a>
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#delete-{{ $book->uuid }}"><i
                                                    class="ni ni-basket text-primary"></i>Delete Book</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <div class="modal fade" id="restore-{{ $book->uuid }}" tabindex="-1" role="dialog"
                                aria-labelledby="modal-form" aria-hidden="true">
                                <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body p-0">
                                            <div class="card bg-secondary border-0 mb-0">
                                                <div class="card-header bg-transparent pb-5">
                                                    <h3 class="text-center">Confirm Book Restore</h3>
                                                </div>
                                                <div class="card-body px-lg-5 py-lg-5">
                                                    <form role="form" action="{{ url('/books/restore/'.$book->uuid) }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="form-group mb-3">
                                                            <div
                                                                class="input-group input-group-merge input-group-alternative">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i
                                                                            class="ni ni-email-83"></i></span>
                                                                </div>
                                                                <input class="form-control" placeholder="Book Title"
                                                                    type="text" value="{{ $book->title }}">
                                                            </div>
                                                        </div>
                                                        <div class="text-center">
                                                            <button type="submit" class="btn btn-primary my-4">Restore
                                                                Book</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="delete-{{ $book->uuid }}" tabindex="-1" role="dialog"
                                aria-labelledby="modal-form" aria-hidden="true">
                                <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body p-0">
                                            <div class="card bg-secondary border-0 mb-0">
                                                <div class="card-header bg-transparent pb-5">
                                                    <h3 class="text-center">Confirm Book Delete</h3>
                                                </div>
                                                <div class="card-body px-lg-5 py-lg-5">
                                                    <form role="form" action="{{ url('/books/'.$book->uuid) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="form-group mb-3">
                                                            <div
                                                                class="input-group input-group-merge input-group-alternative">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i
                                                                            class="ni ni-email-83"></i></span>
                                                                </div>
                                                                <input class="form-control" placeholder="Book Title"
                                                                    type="text" value="{{ $book->title }}">
                                                            </div>
                                                        </div>
                                                        <div class="text-center">
                                                            <button type="submit" class="btn btn-primary my-4">Delete
                                                                Book</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $('document').ready(function() {
        $('table').dataTable();

        @if(Session::has('success'))
            Swal.fire({
                icon:'success',
                title:'Success!',
                text:"{{ Session::get('success') }}",
                timer:5000
            }).then((value) => {
            //location.reload();
            }).catch(swal.noop);
        @endif

        @if(Session::has('fail'))
            Swal.fire({
                icon:'error',
                title:'Oops!',
                text:"{{ Session::get('fail') }}",
                timer:5000
            }).then((value) => {
            //location.reload();
            }).catch(swal.noop);
        @endif
    });
</script>
@endpush
@endsection
