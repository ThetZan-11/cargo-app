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
    {{-- Order Create Modal --}}
    @include('order.create')
    {{-- Order Detail Modal --}}
    @include('order.detail')
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
        let modalRefresh = localStorage.getItem('open_modal') ? localStorage.getItem('open_modal') : '';
        openmodal(modalRefresh)

        function openmodal(modalId) {
            if (modalId == '#detailOrderModal') {
                let detailId = localStorage.getItem('detail_id')
                $.ajax({
                    type: 'GET',
                    url: "{{ route('order.getDataEdit', '') }}/" + detailId,
                    success: function(response) {
                        if (response.status) {
                            console.log(response);
                            response.data.status == 0 ? $('#status_detail').text(
                                "Pending") : $('#status').text(
                                "Completed")
                            $("#total_kg_detail").text(response.data.total_kg + " kg")
                            $("#total_amount_detail").text(response.data.total_amount)
                            $("#total_kg_table").text(response.data.total_kg + " kg")
                            $("#total_amount_table").text(response.data.total_amount)
                            $("#order_date_detail").text(response.data.order_date)
                            $("#arp_no_detail").text(response.data.arp_no)
                            $("#name_detail").text(response.data.customers.name)
                            $("#phone_detail").text(response.data.customers.phone)
                            $("#address_detail").text(response.data.customers.address)
                            $("#price_per_kg_detail").text(response.data.prices.price_per_kg)
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
                            title: "{{ __('word.failed_to_fetch') }}",
                            showConfirmButton: false,
                            timer: 1500,
                            fadeIn: 1000,
                        });
                    }
                });
            }
            $(modalId).modal('show')
        }

        $('#createOrderModal').on("show.bs.modal", () => {
            localStorage.setItem('open_modal', '#createOrderModal');
        })
        $('#detailOrderModal').on("show.bs.modal", () => {
            localStorage.setItem('open_modal', '#detailOrderModal');
        })

        $('#createOrderModal, #detailOrderModal').on("hide.bs.modal", () => {
            localStorage.removeItem('open_modal');
            localStorage.removeItem('detail_id');
        })

        let table = $('#datatable').DataTable({
            serverSide: true,
            responsive: true,
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rtip',
            ajax: {
                url: "{{ route('order.data') }}",
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
                    responsivePriority: 7,
                },
                {
                    data: 'name',
                    name: 'name',
                    className: 'text-center',
                    responsivePriority: 1
                },
                 {
                    data: 'country_flag',
                    name: 'country_flag',
                    className: 'text-center',
                    responsivePriority: 1
                },
                {
                    data: 'address',
                    name: 'address',
                    className: 'text-center',
                    responsivePriority: 2
                },
                {
                    data: 'total_kg',
                    name: 'total_kg',
                    className: 'text-center',
                    responsivePriority: 4
                },
                {
                    data: 'total_amount',
                    name: 'total_amount',
                    className: 'text-center',
                    responsivePriority: 5
                },
                {
                    data: 'status',
                    name: 'status',
                    className: 'text-center',
                    responsivePriority: 6
                },
                {
                    data: 'arp_no',
                    name: 'arp_no',
                    className: 'text-center',
                    responsivePriority: 7
                },
                {
                    data: 'order_date',
                    name: 'order_date',
                    className: 'text-center',
                    responsivePriority: 8
                },
                {
                    data: 'action',
                    name: 'action',
                    className: 'text-center',
                    responsivePriority: 9
                },

            ],
            order: [
                [8, 'desc']
            ],
            language: {
                search: "",
                searchPlaceholder: "{{ __('word.customer_search') }}"
            }
        });

        //Customer Search
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

        //Price Calculate
        let totalKg = $('#total_kg')
        let priceEvl = $('.option');
        totalKg.on("input", () => {
            if (priceEvl.hasClass('selected')) {
                let totalAmount = Math.round(totalKg.val() * $('.selected')[0].dataset.price)
                if (isNaN(totalAmount)) {
                    totalAmount = 0;
                } else {
                    $('#total_amount').val(totalAmount.toLocaleString())
                }
            } else {
                return
            }

        })

        //Create Order Form Submit
        $('#order-form').on('submit', (e) => {
            e.preventDefault();
            let totalAmount = $('#total_amount').val()
            var formData = new FormData($('#order-form')[0])
            $('#loader').css('display', 'flex');
            setTimeout(() => {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('order.store') }}",
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
                        $('#createOrderModal').modal('hide');
                        $('#order-form')[0].reset();
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
        })

        //Order Detail
        $(document).on('click', '.detail-btn', function() {
            let id = $(this).data('id');
            localStorage.setItem('detail_id', id)
            $.ajax({
                type: 'GET',
                url: "{{ route('order.getDataEdit', '') }}/" + id,
                success: function(response) {
                    if (response.status) {
                         response.data.status == 0 ? $('#status_detail').text(
                                "Pending") : $('#status').text(
                                "Completed")
                            $("#total_kg_detail").text(response.data.total_kg + " kg")
                            $("#total_amount_detail").text(response.data.total_amount)
                            $("#total_kg_table").text(response.data.total_kg + " kg")
                            $("#total_amount_table").text(response.data.total_amount)
                            $("#order_date_detail").text(response.data.order_date)
                            $("#arp_no_detail").text(response.data.arp_no)
                            $("#name_detail").text(response.data.customers.name)
                            $("#phone_detail").text(response.data.customers.phone)
                            $("#address_detail").text(response.data.customers.address)
                            $("#price_per_kg_detail").text(response.data.prices.price_per_kg)
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
                        title: "{{ __('word.failed_to_fetch') }}",
                        showConfirmButton: false,
                        timer: 1500,
                        fadeIn: 1000,
                    });
                }
            });
        })

        //Print Function 
        $('#printAddressLabels').click(function() {
            // Get the original address container
            const originalAddress = $('.col-12.col-md-12.col-sm-12').eq(1).find('div').clone();

            // Create print page HTML
            const printHtml = `
            <!DOCTYPE html>
            <html>
            <head>
                <title>Address Labels</title>
                <style>
                    body { 
                        margin: 0; 
                        padding: 0; 
                        font-family: Arial, sans-serif;
                        background: white;
                    }
                    .label-page {
                        width: 8.5in;
                        padding: 0.3in;
                        box-sizing: border-box;
                    }
                    .label-grid {
                        display: grid;
                        grid-template-columns: repeat(2, 1fr);
                        grid-gap: 0.5in;
                    }
                    @media print {
                        body { -webkit-print-color-adjust: exact; }
                        .label-page { padding: 0; }
                    }
                </style>
            </head>
            <body>
                <div class="label-page">
                    <div class="label-grid">
                        ${Array(10).fill(originalAddress.prop('outerHTML')).join('')}
                    </div>
                </div>
                <script>
                    window.onload = function() {
                        setTimeout(function() {
                            window.print();
                            window.close();
                        }, 300);
                    };
                <\/script>
            </body>
            </html>
        `;

            // Open print window
            const printWindow = window.open('', '_blank');
            printWindow.document.open();
            printWindow.document.write(printHtml);
            printWindow.document.close();
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
