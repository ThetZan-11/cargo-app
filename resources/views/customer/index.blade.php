@extends('layout.app')
@section('title', 'Customers')

@section('content')
    <div class="container-fluid px-4">
        <div class="page-title">
            <h1>Customer List</h1>
            <button type="button" class="btn btn-primary" data-mdb-ripple-init data-mdb-modal-init
                data-mdb-target="#createCustomerModal">
                <i class="fa-solid fa-plus me-2"></i>Add Customer
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
                        <table class="table table-hover w-100" id="datatable">
                            <thead>
                                <tr>
                                    <th class="no-sort no-search"></th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Address</th>
                                    <th class="text-center">Phone</th>
                                    <th class="text-center">Phone 2</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                        </table>
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
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('customer.data') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    }
                },
                columns: [{
                        data: 'plus-icon',
                        name: 'plus-icon',
                        className: 'text-center',
                        orderable: false,
                        searchable: false,
                        responsivePriority: 7
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
                        data: 'action',
                        name: 'action',
                        className: 'text-center',
                        orderable: false,
                        searchable: false,
                        responsivePriority: 6
                    }
                ],
                order: [
                    [1, 'desc']
                ]
            });


            // Handle Create Customer Form Submission
            $('#customer-form').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
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
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1500,
                                fadeIn: 1000,
                            });
                        } else {
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1500,
                                fadeIn: 1000,
                            });
                        }
                        $('#createCustomerModal').modal('hide');
                        $('#customer-form')[0].reset();
                        table.ajax.reload();
                    },
                    error: function(xhr, status, error) {
                        var errors = xhr.responseJSON.errors;
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
            });

            // Handle Delete Button Click
            $(document).on('click', '.delete-btn', function() {
                let id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel',
                    customClass: {
                        confirmButton: 'btn btn-danger me-2',
                        cancelButton: 'btn btn-secondary'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('customer.delete', '') }}/" + id,
                            data: {
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                if (response.status) {
                                    Swal.fire({
                                        position: "center",
                                        icon: "success",
                                        title: response.message,
                                        showConfirmButton: false,
                                        timer: 1500,
                                        fadeIn: 1000,
                                    });
                                    table.ajax.reload();
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
                                    title: "Failed to delete customer",
                                    showConfirmButton: false,
                                    timer: 1500,
                                    fadeIn: 1000,
                                });
                            }
                        });
                    }
                });
            });

            // Handle Edit Button Click
            $(document).on('click', '.edit-btn', function() {
                var id = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    url: "{{ route('customer.getDataEdit', '') }}/" + id,
                    success: function(response) {
                        if (response.status) {
                            $('#editCustomerModal').modal('show');
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
                            title: "Failed to fetch customer data",
                            showConfirmButton: false,
                            timer: 1500,
                            fadeIn: 1000,
                        });
                    }
                });
            });
        });
    </script>
@endsection
