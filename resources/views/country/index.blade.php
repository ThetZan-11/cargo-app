@extends('layout.app')
@section('title', __('country.title'))

@section('content')
    <div class="container-fluid px-3">
        <div class="page-title mt-3">
            <h2>{{ __('country.title') }}</h2>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover w-100" id="datatable">
                                <thead>
                                    <tr>
                                        <th class="no-sort no-search"></th>
                                        <th class="text-center">{{ __('country.name') }}</th>
                                        <th class="text-center">{{ __('country.code') }}</th>
                                        <th class="text-center">{{ __('country.flag') }}</th>
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
                    url: "{{ route('country.data') }}",
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
                        responsivePriority: 4
                    }, {
                        data: 'country_name',
                        name: 'country_name',
                        className: 'text-center',
                        responsivePriority: 1
                    },
                    {
                        data: 'country_code',
                        name: 'country_code',
                        className: 'text-center',
                        responsivePriority: 2
                    },
                    {
                        data: 'country_flag',
                        name: 'country_flag',
                        className: 'text-center',
                        responsivePriority: 3
                    },
                ],
                language: {
                    search: "",
                    searchPlaceholder: "{{ __('customer.search') }}"
                }
            });

            //Create Customer Form Submission
            // $('#customer-form').on('submit', function(e) {
            //     e.preventDefault();
            //     var formData = new FormData(this);
            //     $('#loader').css('display', 'flex');
            //     setTimeout(() => {
            //         $.ajax({
            //             type: 'POST',
            //             url: "{{ route('customer.store') }}",
            //             data: formData,
            //             contentType: false,
            //             processData: false,
            //             success: function(response) {
            //                 if (response.status == true) {
            //                     Swal.fire({
            //                         position: "center",
            //                         icon: "success",
            //                         title: response.message,
            //                         showConfirmButton: false,
            //                         timer: 1500,
            //                         fadeIn: 1000,
            //                     });
            //                 }
            //                 $('#loader').css('display', 'none');
            //                 $('#createCustomerModal').modal('hide');
            //                 $('#customer-form')[0].reset();
            //                 table.ajax.reload();
            //             },
            //             error: function(xhr, status, error, response) {
            //                 $('#loader').css('display', 'none');
            //                 var errors = xhr.responseJSON.message;
            //                 console.error(errors);
            //                 Swal.fire({
            //                     position: "center",
            //                     icon: "error",
            //                     title: errors,
            //                     showConfirmButton: false,
            //                     timer: 1500,
            //                     fadeIn: 1000,
            //                 });
            //             }
            //         });
            //     }, 1000);
            // });

            // //Delete Button Click
            // $(document).on('click', '.delete-btn', function() {
            //     let id = $(this).data('id');
            //     Swal.fire({
            //         title: "{{ __('customer.confirm_delete') }}",
            //         text: "{{ __('customer.confirm_delete_text') }}",
            //         icon: 'warning',
            //         showCancelButton: true,
            //         confirmButtonColor: '#3085d6',
            //         cancelButtonColor: '#d33',
            //         confirmButtonText: "{{ __('customer.yes_delete') }}",
            //         cancelButtonText: "{{ __('customer.cancel') }}",
            //         customClass: {
            //             confirmButton: 'btn btn-danger me-2',
            //             cancelButton: 'btn btn-secondary'
            //         },
            //         buttonsStyling: false
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             $('#loader').css('display', 'flex');
            //             setTimeout(() => {
            //                 $.ajax({
            //                     type: 'POST',
            //                     url: "{{ route('customer.delete', '') }}/" + id,
            //                     data: {
            //                         "_token": "{{ csrf_token() }}"
            //                     },
            //                     success: function(response) {
            //                         if (response.status) {
            //                             $('#loader').css('display', 'none');
            //                             Swal.fire({
            //                                 position: "center",
            //                                 icon: "success",
            //                                 title: response.message,
            //                                 showConfirmButton: false,
            //                                 timer: 1500,
            //                                 fadeIn: 1000,
            //                             });
            //                             table.ajax.reload();
            //                         } else {
            //                             $('#loader').css('display', 'none');
            //                             Swal.fire({
            //                                 position: "center",
            //                                 icon: "error",
            //                                 title: response.message,
            //                                 showConfirmButton: false,
            //                                 timer: 1500,
            //                                 fadeIn: 1000,
            //                             });
            //                         }
            //                     },
            //                     error: function(xhr) {
            //                         $('#loader').css('display', 'none');
            //                         Swal.fire({
            //                             position: "center",
            //                             icon: "error",
            //                             title: "{{ __('customer.failed_to_delete') }}",
            //                             showConfirmButton: false,
            //                             timer: 1500,
            //                             fadeIn: 1000,
            //                         });
            //                     }
            //                 });
            //             }, 1000);
            //         }
            //     });
            // });

            // //Edit Button Click for get data
            // $(document).on('click', '.edit-btn', function() {
            //     var id = $(this).data('id');
            //     $('#edit_id').val(id);
            //     $.ajax({
            //         type: 'GET',
            //         url: "{{ route('customer.getDataEdit', '') }}/" + id,
            //         success: function(response) {
            //             if (response.status) {
            //                 $('#editCustomerModal').modal('show');
            //                 $('#edit_id').val(response.data.id);
            //                 $('#edit_name').val(response.data.name);
            //                 $('#edit_email').val(response.data.email);
            //                 $('#edit_phone').val(response.data.phone);
            //                 $('#edit_phone2').val(response.data.phone2);
            //                 $('#edit_address').val(response.data.address);
            //             } else {
            //                 Swal.fire({
            //                     position: "center",
            //                     icon: "error",
            //                     title: response.message,
            //                     showConfirmButton: false,
            //                     timer: 1500,
            //                     fadeIn: 1000,
            //                 });
            //             }
            //         },
            //         error: function(xhr) {
            //             Swal.fire({
            //                 position: "center",
            //                 icon: "error",
            //                 title: "{{ __('customer.failed_to_fetch') }}",
            //                 showConfirmButton: false,
            //                 timer: 1500,
            //                 fadeIn: 1000,
            //             });
            //         }
            //     });
            // });

            // //Edit Customer Form Submission
            // $('#customer-form-edit').on('submit', function(e) {
            //     e.preventDefault();
            //     edit_id = $('#edit_id').val();
            //     var formData = new FormData(this);
            //     $('#loader').css('display', 'flex');
            //     setTimeout(() => {
            //         $.ajax({
            //             type: 'POST',
            //             url: "{{ route('customer.update', '') }}/" + edit_id,
            //             data: formData,
            //             contentType: false,
            //             processData: false,
            //             success: function(response) {
            //                 if (response.status == true) {
            //                     Swal.fire({
            //                         position: "center",
            //                         icon: "success",
            //                         title: response.message,
            //                         showConfirmButton: false,
            //                         timer: 1500,
            //                         fadeIn: 1000,
            //                     });
            //                 }
            //                 $('#loader').css('display', 'none');
            //                 $('#editCustomerModal').modal('hide');
            //                 $('#customer-form-edit')[0].reset();
            //                 table.ajax.reload();
            //             },
            //             error: function(xhr, status, error, response) {
            //                 $('#loader').css('display', 'none');
            //                 var errors = xhr.responseJSON.message;
            //                 Swal.fire({
            //                     position: "center",
            //                     icon: "error",
            //                     title: errors,
            //                     showConfirmButton: false,
            //                     timer: 1500,
            //                     fadeIn: 1000,
            //                 });
            //             }
            //         });
            //     }, 1000);
            // });
        });
    </script>
@endsection
