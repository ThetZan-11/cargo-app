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
        @include('order.edit')
        {{-- Order List Table --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="container-fluid mb-2">
                                <form id="print-form">
                                    <div class="row justify-content-start align-items-center">
                                        <div class="col-sm-6 col-md-5 col-lg-5 mb-1">
                                            <select id="print-selectbox" class="form-select">
                                                <option value="">Select print limit</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6 col-md-2 col-lg-2">
                                            <button type="submit" class="btn btn-primary btn-sm"
                                                id="print-all">Print</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <table class="table-hover w-100 table" id="datatable">
                                <thead>
                                    <tr>
                                        <th class="no-sort no-search"></th>
                                        <th class="no-sort no-search"><input class="form-check-input" type="checkbox"
                                                name="select_all" id="select_all"></th>
                                        <th class="text-center">{{ __('word.customer_name') }}</th>
                                        <th class="text-center">{{ __('word.customer_address') }}</th>
                                        <th class="text-center">{{ __('word.country') }}</th>
                                        <th class="text-center">{{ __('word.total_kg') }}</th>
                                        <th class="text-center">{{ __('word.total_amount') }}</th>
                                        <th class="text-center">{{ __('word.arp_no') }}</th>
                                        <th class="text-center">{{ __('word.order_date') }}</th>
                                        <th class="text-center">{{ __('word.action') }}</th>
                                        <th class="no-search"></th>
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
                    orderDataFetch(detailId);
                }
                if (modalId == '#editOrderrModal') {
                    let editId = localStorage.getItem('order_edit_id')
                    $.ajax({
                        type: 'GET',
                        url: "{{ route('order.getDataEdit', '') }}/" + editId,
                        success: function(response) {
                            let thisResponse = response.receipt
                            if (response.status) {
                                console.log(thisResponse)
                                $('#customer_name_edit').val(thisResponse.customers.name);
                                $('#customer_hidden_id_edit').val(thisResponse.customers.id);
                                $('#various_kg_edit').val(thisResponse.total_kg);
                                $('#various_amount_edit').val(thisResponse.total_amount);
                                $('#order_date_edit').val(thisResponse.order_date);
                                $('#sender_name_edit').val(thisResponse.sender_name);
                                $('#sender_address_edit').val(thisResponse.sender_address);
                                $('#arp_no_edit').val(thisResponse.arp_no);
                                $('#order_desc_edit').val(thisResponse.description);
                                $('#order_id_edit').val(thisResponse.id);

                                let priceId = thisResponse.price_id || (thisResponse.prices &&
                                    thisResponse.prices.id);
                                $('#selected_price_id_edit').val(priceId);
                                let $select = $('#custom-image-select-edit');
                                let $options = $select.find('.option-edit');
                                let $selectedOption = $select.find('.selected-option-edit');
                                let found = $options.filter(function() {
                                    return $(this).data('value') == priceId;
                                });
                                if (found.length) {
                                    $options.removeClass('selected-edit');
                                    found.addClass('selected-edit');
                                    $selectedOption.html(found.find(
                                        '.option-image-edit, .option-text-edit').clone());
                                }
                                if (thisResponse.orders && Array.isArray(thisResponse.orders)) {
                                    console.log(thisResponse.orders)
                                    thisResponse.orders.forEach(function(order) {

                                        // Checkbox
                                        $('#' + order.products.name_en + '_edit').prop(
                                            'checked', true);
                                        $('#' + order.products.name_en + '-container-edit')
                                            .show();
                                        $('#' + order.products.name_en + '_kg_edit').val(
                                            order.total_kg);
                                        $('#' + order.products.name_en + '_total_edit').val(
                                            order.line_total);
                                        if (order.products.name_en !== 'box' || order
                                            .status == 1) {
                                            $('#' + order.products.name_en +
                                                '_kg_plus_edit').prop('checked', true);
                                        }
                                    });
                                }
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
            $('#editOrderrModal').on("show.bs.modal", () => {
                localStorage.setItem('open_modal', '#editOrderrModal');
            })
            $('#detailOrderModal').on("show.bs.modal", () => {
                localStorage.setItem('open_modal', '#detailOrderModal');
            })

            $('#createOrderModal, #detailOrderModal, #editOrderrModal').on("hide.bs.modal", () => {
                localStorage.removeItem('open_modal');
                localStorage.removeItem('detail_id');
                clearInput('#order-form');
                clearInput('#order-form-edit');
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
                        responsivePriority: 1,
                    },
                    {
                        data: 'checkbox',
                        name: 'checkbox',
                        className: 'text-center',
                        orderable: false,
                        searchable: false,
                        responsivePriority: 2,
                    },
                    {
                        data: 'name',
                        name: 'name',
                        className: 'text-center',
                        responsivePriority: 3,
                    },

                    {
                        data: 'address',
                        name: 'address',
                        className: 'text-center',
                        responsivePriority: 4
                    },
                    {
                        data: 'country_flag',
                        name: 'country_flag',
                        className: 'text-center',
                        responsivePriority: 5
                    },
                    {
                        data: 'total_kg',
                        name: 'total_kg',
                        className: 'text-center',
                        responsivePriority: 6
                    },
                    {
                        data: 'total_amount',
                        name: 'total_amount',
                        className: 'text-center',
                        responsivePriority: 7
                    },
                    {
                        data: 'arp_no',
                        name: 'arp_no',
                        className: 'text-center',
                        responsivePriority: 8
                    },
                    {
                        data: 'order_date',
                        name: 'order_date',
                        className: 'text-center',
                        responsivePriority: 9
                    },
                    {
                        data: 'action',
                        name: 'action',
                        className: 'text-center',
                        responsivePriority: 10
                    },
                    {
                        data: 'id',
                        name: 'id',
                        searchable: false,
                        visible: false,
                        searchable: false,
                        className: 'text-center no-sort no-search'
                    },
                ],
                order: [
                    [10, 'desc']
                ],
                language: {
                    search: "",
                    searchPlaceholder: "{{ __('word.customer_search') }}"
                }
            });


            //Print Process
            let printId = []
            $(document).on('click', '.printCheckbox', function() {
                let IdExists = printId.includes($(this).val())
                let InputValue = $(this).val();
                if ($(this)[0].checked) {
                    if (!IdExists) {
                        printId.push(InputValue)
                    }
                } else {
                    let deleteArr = printId.indexOf(InputValue);
                    printId.splice(deleteArr, 1)
                }
                const allChecked = Array.from($('.printCheckbox')).every(checkbox => checkbox.checked);
                if (allChecked) {
                    $('#select_all').prop('checked', true);
                    $('#select_all').prop('indeterminate', false);
                } else if ($('.printCheckbox:checked').length > 0 && !allChecked) {
                    $('#select_all').prop('indeterminate', true);
                    $('#select_all').prop('checked', false);
                } else {
                    $('#select_all').prop('checked', false);
                    $('#select_all').prop('indeterminate', false);
                }
            })

            //For th checkbox
            $('#select_all').on('click', function() {
                let isChecked = $(this).is(':checked');
                $('.printCheckbox').prop('checked', isChecked);
                if (isChecked) {
                    printId = $('.printCheckbox').map(function() {
                        return $(this).val();
                    }).get();
                } else {
                    printId = [];
                }
            });

            //For checkbox when table paginate(draw) 
            table.on('draw', function() {
                $('#select_all').prop('checked', false);
                $('#select_all').prop('indeterminate', false);
                printId = [];
            });

            $('#print-form').on('submit', (e) => {
                e.preventDefault()
                let printSelectVal = Number($('#print-selectbox').val())
                if (printId.length == 0 || printSelectVal == "") {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "Select one customer",
                        showConfirmButton: false,
                        timer: 1500,
                        fadeIn: 1000,
                    });
                    return
                }
                $('#loader').css('display', 'flex');
                $.ajax({
                    type: 'POST',
                    url: "{{ route('order.print') }}",
                    data: JSON.stringify({
                        printId
                    }),
                    contentType: "application/json",
                    processData: false,
                    success: function(response) {
                        $('#loader').css('display', 'none');
                        if (response.status == true) {
                            let originalAddress = ""
                            response.data.forEach(e => {
                                originalAddress += `
                                     <div class="address-container" style="margin-bottom: 8px;">
                                        <div style="display: flex; background: #f8fafc; border-radius: 8px; padding: 25px 15px; border-left: 4px solid #b4c640; box-shadow: 2px 2px 5px #0000000d; align-items: flex-start;">
                                          <div style="flex: 1; max-width: 40%;">
                                            <h3 style="color: #2c3e50; font-size: 0.8rem; font-weight: 600; margin: 0 0 6px 0; display: flex; align-items: center;">
                                              <i class="bi bi-geo-alt me-2"></i>${e.sender_name}
                                            </h3>
                                            <address style="font-style: normal; line-height: 1.4; margin: 0; padding:0px 10px;">
                                              ${e.sender_address}
                                            </address>
                                          </div>
                                          <div style="flex: 1; min-width: 0;">
                                            <h3 style="color: #2c3e50; font-size: 0.8rem; font-weight: 600; margin: 0 0 6px 0; display: flex; align-items: center;">
                                              <i class="bi bi-geo-alt me-2"></i>${e.customers.name}
                                            </h3>
                                            <address style="font-style: normal; line-height: 1.4; margin: 0; padding:0px 10px;">
                                              ${e.customers.address}
                                            </address>
                                          </div>
                                        </div>
                                      </div>
                                    `
                            });

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
                        box-sizing: border-box;
                    }
                    .label-grid {
                        display: flex;
                        flex-direction: column;
                        gap: 20px;
                    }
                    .address-container {
                        page-break-inside: avoid;
                    }
                </style>
            </head>
            <body>
                <div class="label-page">
                    <div class="label-grid">
                        ${Array(printSelectVal).fill(originalAddress).join('')}
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
                        }

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

            })

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
            let totalKg = $('#various_kg')
            let priceEvl = $('.option');
            totalAmount = $('#various_amount')
            let totalKgEdit = $('#various_kg_edit')
            let priceEvlEdit = $('.option-edit');
            totalAmountEdit = $('#various_amount_edit')

            totalKg.on("input", () => {
                calculatePrice(priceEvl, totalAmount, 'selected', totalKg);
            })

            totalKgEdit.on("input", () => {
                calculatePrice(priceEvlEdit, totalAmountEdit, 'selected-edit', totalKgEdit);
            })

            function calculatePrice(price, totalAmountLabel, selectedClass, total_kg) {
                if (price.hasClass(selectedClass)) {
                    let totalAmount = Math.round(total_kg.val() * $('.' + selectedClass)[0].dataset.price)
                    if (isNaN(totalAmount)) {
                        totalAmount = 0;
                    } else {
                        totalAmountLabel.val(totalAmount)
                    }
                } else {
                    return
                }
            }

            //Create Order Form Submit
            $('#order-form').on('submit', (e) => {
                e.preventDefault();
                meatKg = $('#meat_kg').val()
                bookKg = $('#book_kg').val()
                clothKg = $('#cloth_kg').val()
                pharmacyKg = $('#pharmacy_kg').val()
                $('#meat_kg_plus').is(':checked') ? $('#meat_kg_plus').val(meatKg) : $('#meat_kg_plus').val(
                    0)
                $('#book_kg_plus').is(':checked') ? $('#book_kg_plus').val(bookKg) : $('#book_kg_plus').val(
                    0)
                $('#cloth_kg_plus').is(':checked') ? $('#cloth_kg_plus').val(clothKg) : $('#cloth_kg_plus')
                    .val(0)
                $('#pharmacy_kg_plus').is(':checked') ? $('#pharmacy_kg_plus').val(pharmacyKg) : $(
                    '#pharmacy_kg_plus').val(0)
                var formData = new FormData($('#order-form')[0])
                $('#loader').css('display', 'flex');
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
            })

            //Order Detail
            $(document).on('click', '.detail-btn', function() {
                $('#loader').css('display', 'flex');
                let id = $(this).data('id');
                localStorage.setItem('detail_id', id)
                orderDataFetch(id);
                $('#loader').css('display', 'none');
            })

            //clear form input
            function clearInput(form) {
                $(form)[0].reset();
                $('#meat-container').hide();
                $('#book-container').hide();
                $('#pharmacy-container').hide();
                $('#cloth-container').hide();
                $('#box-container').hide();
                $(form).find('.invalid-feedback, .help-block, .text-danger').remove();
                $(form).find('.is-invalid, .has-error').removeClass('is-invalid has-error');
            }

            function orderDataFetch(id) {
                $.ajax({
                    type: 'GET',
                    url: "{{ route('order.getDataEdit', '') }}/" + id,
                    success: function(response) {
                        let receipts = response.receipt
                        if (response.status) {
                            let countryCurrency = receipts.prices.countries.country_code == "SG" ?
                                " $" : " MMK";
                            $('#order_details_container').empty();
                            $('detailOrderModal').modal('show');
                            $("#total_kg_detail").text(receipts.total_kg + " kg")
                            $("#total_amount_detail").text(Number(receipts.total_amount)
                                .toLocaleString() + countryCurrency)
                            $('#order_date_detail').text(receipts.order_date)
                            $('#description_detail').text(receipts.description)
                            $("#arp_no_detail").text(receipts.arp_no)
                            $("#name_detail").text(receipts.customers.name)
                            $("#address_detail").text(receipts.customers.address)
                            $("#phone_detail").text(receipts.customers.phone)
                            $('#sender_name_detail').text(receipts.sender_name)
                            $('#sender_address_detail').text(receipts.sender_address);
                            $("#price_per_kg").text(Number(receipts.prices.price_per_kg)
                                .toLocaleString() + countryCurrency)
                            $("#total_amount_receipt").text(Number(receipts.total_amount)
                                .toLocaleString() + countryCurrency)
                            $("#total_kg_receipt").text(receipts.total_kg + " kg")
                            $("#name_receipt").text(receipts.customers.name)
                            $("#country_receipt").text(receipts.prices.countries.country_name)
                            $('#order_date_receipt').text(receipts.order_date)
                            let lang = {{ App::getLocale() == 'en' ? 'true' : 'false' }};
                            let descContainer = ''
                            let i = 0;
                            receipts.orders.forEach(e => {
                                descContainer +=
                                    `<tr>
                                        <td>${++i}</td>
                                        <td>${e.products.name_en == "box" ? e.products.name_en : e.products.name_mm  }</td>
                                        <td style="text-align: right;" id="total_kg_table">${e.total_kg} ${e.status == 1 ? 'kg':''}</td>
                                        <td style="text-align: right;" id="each_price">${i == 1 ?  Number(receipts.prices.price_per_kg).toLocaleString() : Number(e.line_total).toLocaleString()}</td>
                                        <td style="text-align: right;" id="totaxl_amount_table">${Number(e.line_total).toLocaleString()}</td>
                                    </tr>`
                            });
                            $('#order_details_container').append(descContainer).append(`
                            <tr>
                                        <td>${++i}</td>
                                        <td></td>
                                        <td style="text-align: right;" id="total_kg_table"></td>
                                        <td style="text-align: right;" id="each_price"></td>
                                        <td style="text-align: right;" id="totaxl_amount_table"></td>
                                    </tr>
                                    <tr>
                                        <td>${++i}</td>
                                        <td></td>
                                        <td style="text-align: right;" id="total_kg_table"></td>
                                        <td style="text-align: right;" id="each_price"></td>
                                        <td style="text-align: right;" id="totaxl_amount_table"></td>
                                    </tr>
                                    `)
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

            //Edit Order
            $(document).on('click', '.edit-btn', function() {
                let id = $(this).data('id');
                localStorage.setItem('order_edit_id', id)
                $.ajax({
                    type: 'GET',
                    url: "{{ route('order.getDataEdit', '') }}/" + id,
                    success: function(response) {
                        let thisResponse = response.receipt
                        if (response.status) {
                            console.log(thisResponse)
                            $('#customer_name_edit').val(thisResponse.customers.name);
                            $('#customer_hidden_id_edit').val(thisResponse.customers.id);
                            $('#various_kg_edit').val(thisResponse.total_kg);
                            $('#various_amount_edit').val(thisResponse.total_amount);
                            $('#order_date_edit').val(thisResponse.order_date);
                            $('#sender_name_edit').val(thisResponse.sender_name);
                            $('#sender_address_edit').val(thisResponse.sender_address);
                            $('#arp_no_edit').val(thisResponse.arp_no);
                            $('#order_desc_edit').val(thisResponse.description);
                            $('#order_id_edit').val(thisResponse.id);

                            let priceId = thisResponse.price_id || (thisResponse.prices &&
                                thisResponse.prices.id);
                            $('#selected_price_id_edit').val(priceId);
                            let $select = $('#custom-image-select-edit');
                            let $options = $select.find('.option-edit');
                            let $selectedOption = $select.find('.selected-option-edit');
                            let found = $options.filter(function() {
                                return $(this).data('value') == priceId;
                            });
                            if (found.length) {
                                $options.removeClass('selected-edit');
                                found.addClass('selected-edit');
                                $selectedOption.html(found.find(
                                    '.option-image-edit, .option-text-edit').clone());
                            }
                            if (thisResponse.orders && Array.isArray(thisResponse.orders)) {
                                console.log(thisResponse.orders)
                                thisResponse.orders.forEach(function(order) {

                                    // Checkbox
                                    $('#' + order.products.name_en + '_edit').prop(
                                        'checked', true);
                                    $('#' + order.products.name_en + '-container-edit')
                                        .show();
                                    $('#' + order.products.name_en + '_kg_edit').val(
                                        order.total_kg);
                                    $('#' + order.products.name_en + '_total_edit').val(
                                        order.line_total);
                                    if (order.products.name_en !== 'box' || order
                                        .status == 1) {
                                        $('#' + order.products.name_en +
                                            '_kg_plus_edit').prop('checked', true);
                                    }
                                });
                            }
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

            $('#order-form-edit').on('submit', function(e) {
                e.preventDefault();
                let meatKgEdit = $('#meat_kg_edit').val();
                let bookKgEdit = $('#book_kg_edit').val();
                let clothKgEdit = $('#cloth_kg_edit').val();
                let pharmacyKgEdit = $('#pharmacy_kg_edit').val();

                $('#meat_kg_plus_edit').is(':checked') ? $('#meat_kg_plus_edit').val(meatKgEdit) : $(
                    '#meat_kg_plus_edit').val(0);
                $('#book_kg_plus_edit').is(':checked') ? $('#book_kg_plus_edit').val(bookKgEdit) : $(
                    '#book_kg_plus_edit').val(0);
                $('#cloth_kg_plus_edit').is(':checked') ? $('#cloth_kg_plus_edit').val(clothKgEdit) : $(
                    '#cloth_kg_plus_edit').val(0);
                $('#pharmacy_kg_plus_edit').is(':checked') ? $('#pharmacy_kg_plus_edit').val(
                    pharmacyKgEdit) : $('#pharmacy_kg_plus_edit').val(0);

                var formData = new FormData($('#order-form-edit')[0]);
                $('#loader').css('display', 'flex');
                $.ajax({
                    type: 'POST',
                    url: "{{ route('order.update') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status == true) {
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: '{{ __('word.edit_success') }}',
                                showConfirmButton: false,
                                timer: 1500,
                                fadeIn: 1000,
                            });
                        }
                        $('#loader').css('display', 'none');
                        $('#editOrderrModal').modal('hide');
                        $('#order-form-edit')[0].reset();
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
            });

            //category checkbox 
            let meat = $('#meat');
            let book = $('#book');
            let pharmacy = $('#pharmacy');
            let cloth = $('#cloth');
            let box = $('#box');

            function toggleContainer(checkbox, containerId) {
                if (checkbox.is(':checked')) {
                    $(containerId).show(300);
                } else {
                    $(containerId).hide(300);
                }
            }
            meat.on('change', function() {
                toggleContainer($(this), '#meat-container');
            });
            book.on('change', function() {
                toggleContainer($(this), '#book-container');
            });
            pharmacy.on('change', function() {
                toggleContainer($(this), '#pharmacy-container');
            });
            cloth.on('change', function() {
                toggleContainer($(this), '#cloth-container');
            });
            box.on('change', function() {
                toggleContainer($(this), '#box-container');
            });

            $('#meat_edit').on('change', function() {
                toggleContainer($(this), '#meat-container-edit');
            });
            $('#book_edit').on('change', function() {
                toggleContainer($(this), '#book-container-edit');
            });
            $('#pharmacy_edit').on('change', function() {
                toggleContainer($(this), '#pharmacy-container-edit');
            });
            $('#cloth_edit').on('change', function() {
                toggleContainer($(this), '#cloth-container-edit');
            });
            $('#box_edit').on('change', function() {
                toggleContainer($(this), '#box-container-edit');
            });
        });

        function printReceipt() {
            const receiptContent = document.getElementById('receipt-section').outerHTML;
            const printWindow = window.open('', '', 'width=1000,height=800');

            printWindow.document.write(`
        <html>
        <head>
            <title>Receipt</title>
        </head>
        <link href="{{ asset('assets/MDB5/css/mdb.min.css') }}" rel="stylesheet" />
        <!-- DataTables CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap5.min.css') }}">
        <style>
            @page {
                    size: A5 portrait;
                }
            body *{
            font-size: 13px !important;
            }
            h1{
            font-size: 25px !important;
            }
            table{
            width: 100% !important;
            }
            th{
            font-weight: 700 !important;
            }
            td, th{
            padding: 2px 5px !important;
            height: 30px !important; 
            }
            img{
            max-height: 100px !important;
            }
            .greeting,.sign, #address-container{
                font-size: 10px !important;
                font-weight: 700;
            }
            
        </style>
        <body onload="window.print(); setTimeout(() => window.close(), 200);">
            ${receiptContent}
        </body>
        </html>
    `);

            printWindow.document.close();
        }
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
