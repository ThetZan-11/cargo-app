@extends('layout.app')
@section('title', 'Customers')

@section('styles')
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid px-4">
        <div class="page-title">
            <h1>Customer List</h1>
            <a href="{{ route('customer.create') }}" class="btn btn-primary" data-mdb-ripple-init>
                <i class="fa-solid fa-plus me-2"></i>Add Customer
            </a>
        </div>

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
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

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

            // Handle Delete Button Click
            $(document).on('click', '.delete-btn', function() {
                let id = atob($(this).data('id'));
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
                var id = atob($(this).data('id'));
            });
        });
    </script>
@endsection
