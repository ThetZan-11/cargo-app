@extends('layout.app')
@section('title', __('word.order_title'))

@section('content')
    <div class="container-fluid px-3">
        <div class="page-title mt-3">
            <h2>{{ __('word.order_title') }}</h2>
            <button type="button" class="btn btn-primary fs-7 btn-sm" data-mdb-ripple-init data-mdb-modal-init
                data-mdb-target="#createOrderModal">
                <i class="fa-solid fa-plus me-2"></i>{{ __('word.create') }}
            </button>
        </div>
        {{-- Order Modal --}}
        @include('order.create')
        {{-- Edit Order Modal --}}
        {{-- @include('order.edit') --}}
        {{-- Order List Table --}}
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
                                        <th class="text-center">{{ __('word.customer_address') }}</th>
                                        <th class="text-center">{{ __('word.total_kg') }}</th>
                                        <th class="text-center">{{ __('word.total_amount') }}</th>
                                        <th class="text-center">{{ __('word.order_status') }}</th>
                                        <th class="text-center">{{ __('word.arp_no') }}</th>
                                        <th class="text-center">{{ __('word.order_date') }}</th>
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
            // let table = $('#datatable').DataTable({
            //     serverSide: true,
            //     responsive: true,
            //     dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rtip',
            //     beforeSend: function() {
            //         $('#loader').css('display', 'flex');
            //     },
            //     ajax: {
            //         url: "{{ route('customer.data') }}",
            //         type: "POST",
            //         data: {
            //             "_token": "{{ csrf_token() }}"
            //         }
            //     },
            //     complete: function() {
            //         $('#loader').css('display', 'none');
            //     },
            //     columns: [{
            //             data: 'plus-icon',
            //             name: 'plus-icon',
            //             className: 'text-center',
            //             orderable: false,
            //             searchable: false,
            //             responsivePriority: 7,
            //         }, {
            //             data: 'name',
            //             name: 'name',
            //             className: 'text-center',
            //             responsivePriority: 1
            //         },
            //         {
            //             data: 'email',
            //             name: 'email',
            //             className: 'text-center',
            //             responsivePriority: 2
            //         },
            //         {
            //             data: 'address',
            //             name: 'address',
            //             className: 'text-center',
            //             responsivePriority: 5
            //         },
            //         {
            //             data: 'phone',
            //             name: 'phone',
            //             className: 'text-center',
            //             responsivePriority: 3
            //         },
            //         {
            //             data: 'phone2',
            //             name: 'phone2',
            //             className: 'text-center',
            //             responsivePriority: 4
            //         },
            //         {
            //             data: 'updated_at',
            //             name: 'updated_at',
            //             responsivePriority: 5
            //         },
            //         {
            //             data: 'action',
            //             name: 'action',
            //             className: 'text-center',
            //             orderable: false,
            //             searchable: false,
            //             responsivePriority: 6
            //         }
            //     ],
            //     order: [
            //         [6, 'desc']
            //     ],
            //     language: {
            //         search: "",
            //         searchPlaceholder: "{{ __('word.customer_search') }}"
            //     }
            // });

            $('#customer_name').on('input', function() {
                var value = $(this).val();
                if (value.length == 0) {
                    $('#customer-table').hide();
                    $('#customer-details').empty();
                    return;
                }

                function selectCustomer(id, name) {
                    let customerName = name;
                    let customerId = id;
                    $('#customer_hidden_id').val(customerId);
                    $('#customer_name').val(customerName);
                    $('#customer-table').hide();
                    $('#customer-details').empty();
                }
                setTimeout(() => {
                    $.ajax({
                        url: "{{ route('customer.search') }}",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "search": value
                        },
                        success: function(res) {
                            $('#customer-details').empty();
                            $('#customer-table').show();
                            if (res.data.length === 0) {
                                $('#customer-table').css('overflow', 'hidden');
                                $('#customer-details').append(`
                                    <tr class="table-danger text-center">
                                        <td colspan="3">{{ __('word.no_data_found') }}</td>
                                    </tr>
                                `);
                                return;
                            } else {
                                $('#customer-table').css('overflow-y', 'scroll');
                                res.data.forEach(element => {
                                    $("<tr>").addClass(
                                            "table-warning text-left cursor-pointer table-tr"
                                        )
                                        .css({
                                            'cursor': 'pointer',
                                        })
                                        .on("click", function() {
                                            selectCustomer(element.id,
                                                element.name);
                                        })
                                        .append(`<td>${element.name}</td>`)
                                        .append(`<td>${element.phone}</td>`)
                                        .append(`<td>${element.address}</td>`)
                                        .appendTo('#customer-details');
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Search failed:", error);
                        }
                    });
                }, 300);

            });


        });
    </script>
@endsection

@section('styles')
    <style>
        .table-th th {
            font-size: 15px !important;
            padding: 5px !important;
            margin: 5px !important;
        }

        .table-tr td {
            font-size: 13px !important;
            padding: 5px !important;
            margin: 5px !important;
        }

        .table-th,
        .table-tr {
            height: 50px !important;
        }
    </style>
@endsection
