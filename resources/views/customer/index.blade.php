@extends('layout.app')
@section('title', __('word.customer_title'))

@section('content')
    <div class="container-fluid px-3">
        <div class="page-title mt-3">
            <h2>{{ __('word.customer_title') }}</h2>
            <button type="button" class="btn btn-primary fs-7 btn-sm" data-mdb-ripple-init data-mdb-modal-init
                data-mdb-target="#createCustomerModal">
                <i class="fa-solid fa-plus me-2"></i>{{ __('word.create') }}
            </button>
        </div>
        {{-- Customer Modal --}}
        @include('customer.create')
        {{-- Edit Customer Modal --}}
        @include('customer.edit')
        {{-- Customer List Table --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover w-100" id="datatable">
                                <thead>
                                    <tr>
                                        <th class="no-sort no-search"></th>
                                        <th class="text-center">{{ __('word.customer_name') }}</th>
                                        <th class="text-center">{{ __('word.customer_email') }}</th>
                                        <th class="text-center">{{ __('word.customer_address') }}</th>
                                        <th class="text-center">{{ __('word.customer_phone') }}</th>
                                        <th class="text-center">{{ __('word.customer_phone2') }}</th>
                                        <th class="hidden"></th>
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
                    url: "{{ route('customer.data') }}",
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
                        responsivePriority: 7,
                    }, {
                        data: 'name',
                        name: 'name',
                        className: 'text-center',
                        responsivePriority: 1
                    },
                    {
                        data: 'email',
                        name: 'email',
                        className: 'text-center',
                        responsivePriority: 2
                    },
                    {
                        data: 'address',
                        name: 'address',
                        className: 'text-center',
                        responsivePriority: 5
                    },
                    {
                        data: 'phone',
                        name: 'phone',
                        className: 'text-center',
                        responsivePriority: 3
                    },
                    {
                        data: 'phone2',
                        name: 'phone2',
                        className: 'text-center',
                        responsivePriority: 4
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at',
                        responsivePriority: 5
                    },
                    {
                        data: 'action',
                        name: 'action',
                        className: 'text-center',
                        orderable: false,
                        searchable: false,
                        responsivePriority: 6
                    }
                ],
                order: [
                    [6, 'desc']
                ],
                language: {
                    search: "",
                    searchPlaceholder: "{{ __('word.customer_search') }}"
                }
            });

            //Create Customer Form Submission
            $('#customer-form').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $('#loader').css('display', 'flex');
                setTimeout(() => {
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('customer.store') }}",
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
                            $('#createCustomerModal').modal('hide');
                            $('#customer-form')[0].reset();
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
                                url: "{{ route('customer.delete', '') }}/" + id,
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

            //Edit Button Click for get data
            $(document).on('click', '.edit-btn', function() {
                var id = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    url: "{{ route('customer.getDataEdit', '') }}/" + id,
                    success: function(response) {
                        console.log(response);
                        if (response.status) {
                            $('#editCustomerModal').modal('show');
                            $('#edit_id').val(btoa(response.data.id));
                            $('#edit_name').val(response.data.name);
                            $('#edit_email').val(response.data.email);
                            $('#edit_phone').val(response.data.phone);
                            $('#edit_phone2').val(response.data.phone2);
                            $('#edit_address').val(response.data.address);
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

            //Edit Customer Form Submission
            $('#customer-form-edit').on('submit', function(e) {
                e.preventDefault();
                edit_id = $('#edit_id').val()
                var formData = new FormData(this);
                $('#loader').css('display', 'flex');
                setTimeout(() => {
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('customer.update', '') }}/" + edit_id,
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
                            $('#editCustomerModal').modal('hide');
                            $('#customer-form-edit')[0].reset();
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
