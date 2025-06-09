@extends('layout.app')
@section('title', __('word.price_title'))

@section('content')
    <div class="container-fluid px-3">
        <div class="page-title mt-3">
            <h2>{{ __('word.price_title') }}</h2>
            <button type="button" class="btn btn-primary fs-7 btn-sm" data-mdb-ripple-init data-mdb-modal-init
                data-mdb-target="#createPriceModal">
                <i class="fa-solid fa-plus me-2"></i>{{ __('word.create') }}
            </button>
        </div>
        {{-- Price Modal --}}
        @include('price.create')
        {{-- Price Edit Modal --}}
        @include('price.edit')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover w-100" id="datatable">
                                <thead>
                                    <tr>
                                        <th class="no-sort no-search"></th>
                                        <th class="text-center">{{ __('word.flag') }}</th>
                                        <th class="text-center">{{ __('word.min_kg') }}</th>
                                        <th class="text-center">{{ __('word.max_kg') }}</th>
                                        <th class="text-center">{{ __('word.price') }}</th>
                                        <th class="text-center">{{ __('word.action') }}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            let table = $('#datatable').DataTable({
                serverSide: true,
                responsive: true,
                dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rtip',
                beforeSend: function() {
                    $('#loader').css('display', 'flex');
                },
                ajax: {
                    url: "{{ route('price.data') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    }
                },
                complete: function() {
                    $('#loader').css('display', 'none');
                },
                columns: [{
                        data: 'plus-icon',
                        name: 'plus-icon',
                        className: 'text-center',
                        orderable: false,
                        searchable: false,
                        responsivePriority: 6,
                    },
                    {
                        data: 'country_flag',
                        name: 'country_flag',
                        className: 'text-center',
                        responsivePriority: 1,
                        render: function(data) {
                            return `<img src="${data}" alt="Country flag" style="border: 1px solid #ccc; border-radius: 4px; height: 20px; width: 30px;">`;
                        }
                    },
                    {
                        data: 'min_kg',
                        name: 'min_kg',
                        className: 'text-center',
                        responsivePriority: 2
                    },
                    {
                        data: 'max_kg',
                        name: 'max_kg',
                        className: 'text-center',
                        responsivePriority: 3
                    },
                    {
                        data: 'price_per_kg',
                        name: 'price_per_kg',
                        className: 'text-center',
                        responsivePriority: 4
                    },
                    {
                        data: 'action',
                        name: 'action',
                        className: 'text-center',
                        orderable: false,
                        searchable: false,
                        responsivePriority: 5
                    },
                ],
                order: [
                    [1, 'asc']
                ],
                language: {
                    search: "",
                    searchPlaceholder: "{{ __('word.price_search') }}"
                }
            });

            //Price Create
            $('#price-form').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $('#loader').css('display', 'flex');
                setTimeout(() => {
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('price.store') }}",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.status == true) {
                                Swal.fire({
                                    position: "center",
                                    icon: "success",
                                    title: '{{ __('word.create_success') }}',
                                    showConfirmButton: false,
                                    timer: 1500,
                                    fadeIn: 1000,
                                });
                            }
                            $('#loader').css('display', 'none');
                            $('#createPriceModal').modal('hide');
                            $('#price-form')[0].reset();
                            table.ajax.reload();
                        },
                        error: function(xhr, status, error, response) {
                            $('#loader').css('display', 'none');
                            var errors = xhr.responseJSON.message;
                            console.error(errors);
                            Swal.fire({
                                position: "center",
                                icon: "error",
                                title: errors,
                                showConfirmButton: false,
                                timer: 1500,
                                fadeIn: 1000,
                            });
                        }
                    });
                }, 1000);
            });

            //Delete Button Click
            $(document).on('click', '.delete-btn', function() {
                let id = $(this).data('id');
                Swal.fire({
                    title: "{{ __('word.confirm_delete') }}",
                    text: "{!! __('word.confirm_delete_text') !!}",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "{{ __('word.yes_delete') }}",
                    cancelButtonText: "{{ __('word.cancel') }}",
                    customClass: {
                        confirmButton: 'btn btn-danger me-2',
                        cancelButton: 'btn btn-secondary'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#loader').css('display', 'flex');
                        setTimeout(() => {
                            $.ajax({
                                type: 'POST',
                                url: "{{ route('price.delete', '') }}/" + id,
                                data: {
                                    "_token": "{{ csrf_token() }}"
                                },
                                success: function(response) {
                                    if (response.status) {
                                        $('#loader').css('display', 'none');
                                        Swal.fire({
                                            position: "center",
                                            icon: "success",
                                            title: "{{ __('word.success') }}",
                                            showConfirmButton: false,
                                            timer: 1500,
                                            fadeIn: 1000,
                                        });
                                        table.ajax.reload();
                                    } else {
                                        $('#loader').css('display', 'none');
                                        Swal.fire({
                                            position: "center",
                                            icon: "error",
                                            title: "{{ __('word.failed_to_delete') }}",
                                            showConfirmButton: false,
                                            timer: 1500,
                                            fadeIn: 1000,
                                        });
                                    }
                                },
                                error: function(xhr) {
                                    $('#loader').css('display', 'none');
                                    Swal.fire({
                                        position: "center",
                                        icon: "error",
                                        title: "{{ __('word.failed_to_delete') }}",
                                        showConfirmButton: false,
                                        timer: 1500,
                                        fadeIn: 1000,
                                    });
                                }
                            });
                        }, 1000);
                    }
                });
            });

            // //Edit Button Click for get data
            $(document).on('click', '.edit-btn', function() {
                var id = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    url: "{{ route('price.getDataEdit', '') }}/" + id,
                    success: function(response) {
                        console.log(response.data);
                        if (response.status) {
                            $('#editPriceModal').modal('show');
                            $('#edit_id').val(btoa(response.data.id));
                            $('#edit_country').val(response.data.country_id);
                            $('#edit_min_kg').val(response.data.min_kg);
                            $('#edit_max_kg').val(response.data.max_kg);
                            $('#edit_price').val(response.data.price_per_kg);
                        } else {
                            Swal.fire({
                                position: "center",
                                icon: "error",
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1500,
                                fadeIn: 1000,
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: "{{ __('customer.failed_to_fetch') }}",
                            showConfirmButton: false,
                            timer: 1500,
                            fadeIn: 1000,
                        });
                    }
                });
            });

            // //Edit Customer Form Submission
            $('#price-form-edit').on('submit', function(e) {
                e.preventDefault();
                edit_id = $('#edit_id').val()
                var formData = new FormData(this);
                $('#loader').css('display', 'flex');
                setTimeout(() => {
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('price.update', '') }}/" + edit_id,
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.status == true) {
                                Swal.fire({
                                    position: "center",
                                    icon: "success",
                                    title: '{{ __('word.update_success') }}',
                                    showConfirmButton: false,
                                    timer: 1500,
                                    fadeIn: 1000,
                                });
                            }
                            $('#loader').css('display', 'none');
                            $('#editPriceModal').modal('hide');
                            $('#price-form-edit')[0].reset();
                            table.ajax.reload();
                        },
                        error: function(xhr, status, error, response) {
                            $('#loader').css('display', 'none');
                            var errors = xhr.responseJSON.message;
                            Swal.fire({
                                position: "center",
                                icon: "error",
                                title: errors,
                                showConfirmButton: false,
                                timer: 1500,
                                fadeIn: 1000,
                            });
                        }
                    });
                }, 1000);
            });
        });
    </script>
@endsection
