@extends('layouts.layout')

@section('title', 'Add New Book')

@section('content')
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css"
    integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw=="
    crossorigin="anonymous" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-selection__rendered {
        line-height: 31px !important;
    }

    .select2-container .select2-selection--single {
        height: 35px !important;
    }

    .select2-selection__arrow {
        height: 34px !important;
    }
</style>
@endpush
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0">Add New Book</h3>
                </div>
                <div class="card-body">
                    <div id="errors" class="alert alert-danger " role="alert" style="color: white;"></div>
                    <form enctype="multipart/form-data" id="create-book">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Title</label>
                                    <input type="text" class="form-control" id="title" placeholder="Title" name="title"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Author</label>
                                    <input type="text" class="form-control" id="author" placeholder="Author"
                                        name="author" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Publisher</label>
                                    <input type="text" class="form-control" id="publisher" placeholder="Publisher"
                                        name="publisher" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Date Published</label>
                                    <input type="date" max="{{ date('Y-m-d') }}" class="form-control"
                                        id="date_published" placeholder="Date Published" name="date_published" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea class="form-control" id="description" rows="3" required></textarea>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Front Cover(Image)</label>
                                    <input class="form-control-file" name="front_cover" id="front_cover" type="file"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>File</label>
                                    <input class="form-control-file" name="file" id="file" type="file" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12">
                                <button type="button" class="btn btn-primary btn-md float-right" id="save_book">Save
                                    Book</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.partials.footer')
</div>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.2/tinymce.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
    integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-serialize-object/2.5.0/jquery.serialize-object.min.js"
    integrity="sha256-E8KRdFk/LTaaCBoQIV/rFNc0s3ICQQiOHFT4Cioifa8=" crossorigin="anonymous"></script>

<script>
    $('document').ready(function() {

            $('#errors').hide();

            tinymce.init({
                selector: 'textarea'
            });

            function validate_form(data) {
                var valid_form;
                $.each(data, function(key, field) {
                    if (field.value == "") {
                    valid_form = 0;
                    return false;
                    } else {
                    valid_form = 1;
                    }

                });

                return valid_form;
            }

            $('input[type="file"]').dropify();

        $('#save_book').click(function(e) {
            e.preventDefault();

            $(this).attr('disabled', 'disabled');

            var form_data = $('#create-book').serializeArray();

            var valid_form = validate_form(form_data);

            if (valid_form == 0) {

                Swal.fire("Error!", "All Fields are Compulsory!", "error");
                $(this).removeAttr('disabled');

                return false;

            }

            const form = $('#new-book')[0];

            const description = tinymce.get("description").getContent();

            const front_cover = $("#front_cover")[0].files[0];

            const file = $("#file")[0].files[0];

            const title = $('#title').val();

            const author = $('#author').val();

            const publisher = $('#publisher').val();

            const date_published = $('#date_published').val();

            formData = new FormData(form);
            formData.append('description', description);
            formData.append('front_cover', front_cover);
            formData.append('author', author);
            formData.append('publisher', publisher);
            formData.append('file', file);
            formData.append('date_published', date_published);
            formData.append('title', title);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('books.store') }}",
                processData: false,
                contentType: false,
                method: "POST",
                data: formData,
                beforeSend: function () {
                    Swal.fire({
                    title: 'Saving Book Details',
                    allowOutsideClick: false,
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    },
                    });
                },
                success: function(data) {

                    Swal.close();

                    if (data.status == 1) {
                    Swal.fire({
                        title: "New Book Sucessfully Saved!",
                        text: "New Book has been sucessfully saved into the inventory.",
                        icon: "success",
                    });

                    window.setTimeout(function() {

                        window.location = "{{ route('books.index') }}";

                    }, 3000);


                    } else {

                    Swal.fire({
                        title: "Error!",
                        text: data.msg,
                        icon: "error",
                    });

                    $('button').removeAttr('disabled');

                    }

                },
                error: function (xhr, status, error) {
                    //other stuff
                    swal.close();

                    var errors = $.parseJSON(xhr.responseText);

                    errors = errors.errors;

                    console.log(errors);

                    if (errors != null) {

                    var items = '<ul>';

                    $.each(errors, function (key, value) {
                        items += '<li>'+key+': '+value+'</li>';
                    });

                    items += '</ul>';

                        $('#errors').empty();

                        $('#errors').append(items);

                        $('#errors').show();

                    }

                    setTimeout(function () {
                        Swal.fire({
                        icon: 'error',
                        title: 'Error ' + xhr.status,
                        text: xhr.responseJSON.message,
                        timer: 5000
                        }).then((value) => {}).catch(swal.noop)
                    }, 1000);

                    $('button').removeAttr('disabled');
                    }
            });
        });

    });
</script>
@endpush
@endsection
