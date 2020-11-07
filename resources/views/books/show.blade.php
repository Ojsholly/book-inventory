@extends('layouts.layout')

@section('title', 'Show Book')

@section('content')
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Book Details</h3>
                        </div>
                        <div class="col-4 text-right">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form>
                        <h6 class="heading-small text-muted mb-4">Book information</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Title</label>
                                        <p>{{ $book->title }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">Author</label>
                                        <p>{{ $book->author }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Publisher</label>
                                        <p>{{ $book->publisher }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-last-name">Date Published</label>
                                        <p>{{ date('l jS F Y', strtotime($book->date_published)) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4" />
                        <!-- Address -->
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-address">Cover</label>
                                        <img class="img img-fluid img-responsive" src="{{ $book->get_front_cover() }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4" />
                        <div class="pl-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Description</label>
                                {!! $book->description !!}
                            </div>
                            <div class="form-row">
                                <div class="col-md-3">
                                    <a class="btn btn-primary btn-sm" href="{{ $book->file_path() }}">Preview Book</a>
                                </div>
                                <div class="col-md-3">
                                    <a class="btn btn-default btn-sm"
                                        href="{{ url('books/'.$book->uuid.'/edit') }}">Edit Book</a>
                                </div>
                                <div class="col-md-3">
                                    <a class="btn btn-warning btn-sm" href="#" data-toggle="modal"
                                        data-target="#archive-{{ $book->uuid }}">Archive Book</a>
                                </div>
                                <div class="col-md-3">
                                    <a class="btn btn-danger btn-sm" href="#" data-toggle="modal"
                                        data-target="#delete-{{ $book->uuid }}">Delete Book</a>
                                </div>
                            </div>
                            <div class="modal fade" id="archive-{{ $book->uuid }}" tabindex="-1" role="dialog"
                                aria-labelledby="modal-form" aria-hidden="true">
                                <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body p-0">
                                            <div class="card bg-secondary border-0 mb-0">
                                                <div class="card-header bg-transparent pb-5">
                                                    <h3 class="text-center">Confirm Book Archive</h3>
                                                </div>
                                                <div class="card-body px-lg-5 py-lg-5">
                                                    <form role="form" action="{{ url('/books/archive/'.$book->uuid) }}"
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
                                                            <button type="submit" class="btn btn-primary my-4">Archive
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.partials.footer')
</div>

@endsection
