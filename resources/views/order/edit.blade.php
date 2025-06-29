<div class="modal fade modal-xl" id="editOrderrModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('word.order_edit') }}</h5>
                <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <form id="order-form">
                                        @csrf
                                        <div data-mdb-input-init class="form-group position-relative">
                                            <label class="form-label"
                                                for="customer_name">{{ __('word.customer_name') }}</label>
                                            <input type="hidden" name="customer_hidden_id_edit" id="customer_hidden_id_edit">
                                            <input type="text" id="customer_name_edit" name="customer_name_edit"
                                                class="form-control" placeholder="{{ __('word.customer_search') }}" />
                                        </div>
                                        <div style="overflow-y: scroll; height: 300px; width: auto; display: none; border-radius:10px; box-shadow: 3px 3px 3px #b9b8b876;"
                                            id="customer-table">
                                            <table class="table table-bordered mt-1" style=" width: 100%;">
                                                <thead>
                                                    <tr class="text-center table-th">
                                                        <th>{{ __('word.customer_name') }}</th>
                                                        <th>{{ __('word.customer_phone') }}</th>
                                                        <th>{{ __('word.customer_address') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="customer-details">

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label class="form-label" for="total_kg">{{ __('word.total_kg') }}</label>
                                            <input type="text" id="total_kg_edit" name="total_kg_edit" class="form-control"
                                                placeholder="{{ __('word.total_kg_enter') }}" />
                                        </div>
                                        <div class="form-group mt-3">
                                            <label class="form-label" for="country">{{ __('word.price') }}</label>
                                            <div class="custom-image-select-edit">
                                                <div class="select-header-edit">
                                                    <div class="selected-option-edit">
                                                        <span class="option-text-edit">{{ __('word.price_select') }}</span>
                                                    </div>
                                                    <i class="fa-solid fa-down-long" id="select-arrow-edit"></i>
                                                </div>
                                                <div class="select-options-edit">
                                                    
                                                    @foreach ($prices as $price)
                                                        <div class="option-edit" data-price="{{ $price->price_per_kg }}"
                                                            data-value="{{ $price->id }}">
                                                            <img src="{{ $price->countries->country_flag }}"
                                                                class="option-image-edit">
                                                            <span class="option-text-edit">
                                                                <span>{{ __('word.min_kg') }} -
                                                                    {{ $price->min_kg }} Kg</span>
                                                                <span>{{ __('word.max_kg') }} -
                                                                    {{ $price->max_kg }} Kg</span>
                                                                <span id="priceEvl-edit">{{ __('word.price') }}
                                                                    -
                                                                    {{ $price->countries->country_code == 'SG' ? $price->price_per_kg : number_format($price->price_per_kg) }}
                                                                    {{ $price->countries->country_code == 'SG' ? " $" : ' MMK' }}</span>
                                                                ({{ $price->countries->country_name }})
                                                            </span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <input type="hidden" name="selected_price_id" id="selected_price_id_edit"
                                                    value="">
                                            </div>
                                        </div>
                                        <div data-mdb-input-init class="form-group mt-3">
                                            <label class="form-label"
                                                for="min_kg">{{ __('word.total_amount') }}</label>
                                            <input type="text" id="total_amount_edit" name="total_amount_edit"
                                                class="form-control" value="0" />
                                        </div>
                                        <div class="form-group mt-3">
                                            <label class="form-label" for="arp_no">ARP NO</label>
                                            <input type="text" id="arp_no_edit" name="arp_no_edit" class="form-control"
                                                placeholder="{{ __('word.arp_no_enter') }}" />
                                        </div>
                                        <div class="form-group mt-3">
                                            <label class="form-label"
                                                for="order_date">{{ __('word.order_status') }}</label>
                                            <select name="order_status_edit" id="order_status_edit" class="form-select">
                                                <option value="0">Pending</option>
                                                <option value="1">Completed</option>
                                            </select>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label class="form-label"
                                                for="order_date">{{ __('word.descrioption') }}</label>
                                            <textarea class="form-control" id="order_desc_edit" placeholder="{{ __('word.enter_desc') }}" name="order_desc_edit"
                                                rows="3"></textarea>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label class="form-label"
                                                for="order_date">{{ __('word.order_date') }}</label>
                                            <input type="date" id="order_date_edit" name="order_date_edit"
                                                class="form-control" placeholder="{{ __('word.date_enter') }}" />
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-mdb-ripple-init
                    data-mdb-dismiss="modal">{{ __('word.cancel') }}</button>
                <button type="submit" class="btn btn-primary" data-mdb-ripple-init>{{ __('word.save') }}</button>
                </form>
                {!! JsValidator::formRequest('App\Http\Requests\OrderCreateRequest', '#order-form') !!}
            </div>
        </div>
    </div>
</div>
@section('styles')
    {{-- <style>
        .custom-image-select {
            position: relative;
            width: 100%;
            max-width: 100%;
            font-family: 'Segoe UI', Roboto, sans-serif;
            user-select: none;
            margin-bottom: 15px;
        }

        .select-header {
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 12px 15px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            min-height: 44px;
        }

        .select-header:hover {
            border-color: #b3b3b3;
        }

        .select-options {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            margin-top: 5px;
            max-height: 30vh;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 0 4px 12px #0000001a;
            width: 100%;
        }

        .option {
            padding: 12px 15px;
            cursor: pointer;
            display: flex;
            align-items: center;
            transition: all 0.2s ease;
            min-height: 44px;
            border-bottom: 2px solid #0000001a;
        }

        .option-text,
        .option-text span {
            font-size: 16px;
            color: #2d2b2bc3;
        }

        .option-text span {
            background-color: #dee129d5;
            padding: 8px;
            border-radius: 5px;
            display: inline-block;
            margin-right: 5px;
            margin-bottom: 3px;
        }

        .option:hover {
            background-color: #999595b1;
        }

        .option.selected {
            background-color: #6d6e1892;
            color: white;
        }

        .option-image {
            width: 30px;
            height: 20px;
            margin-right: 12px;
            border-radius: 3px;
            border: 1px solid black;
            flex-shrink: 0;
        }

        .selected-option {
            display: flex;
            align-items: center;
            flex-grow: 1;
            overflow: hidden;
        }

        #select-arrow {
            color: #6d6e18;
            transition: transform 0.3s ease;
            margin-left: 10px;
            flex-shrink: 0;
        }

        .custom-image-select.active #select-arrow {
            transform: rotate(180deg);
        }

        .custom-image-select.active .select-options {
            display: block;
        }

        /* Responsive adjustments for tablets */
        @media (max-width: 992px) {
            .option-text span {
                padding: 6px;
                font-size: 14px;
            }
        }

        /* Mobile styles */
        @media (max-width: 768px) {

            .select-header,
            .option {
                padding: 14px 15px;
            }

            .option-text,
            .option-text span {
                font-size: 15px;
            }

            .select-options {
                position: fixed;
                top: auto;
                bottom: 0;
                left: 0;
                right: 0;
                max-height: 50vh;
                border-radius: 12px 12px 0 0;
                margin-top: 0;
                animation: slideUp 0.3s ease;
            }

            @keyframes slideUp {
                from {
                    transform: translateY(100%);
                }

                to {
                    transform: translateY(0);
                }
            }

            .custom-image-select.active::after {
                content: '';
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
            }

            .option {
                flex-wrap: wrap;
            }

            .option-text span {
                display: block;
                width: 100%;
                margin-bottom: 5px;
            }
        }

        /* Small mobile devices */
        @media (max-width: 480px) {
            .option-image {
                width: 35px;
                height: 25px;
            }

            .option-text span {
                font-size: 13px;
                padding: 5px;
            }

            .select-header {
                padding: 12px;
            }
        }
    </style> --}}
@endsection
<script>
    $(document).ready(function() {
        // Initialize select box
        $('.custom-image-select-edit').each(function() {
            const $select = $(this);
            const $header = $select.find('.select-header-edit');
            const $options = $select.find('.option-edit');
            const $selectedIdInput = $select.find('#selected_id_edit');
            const $selectedTextInput = $select.find('#selected_text_edit');
            const $selectedOption = $select.find('.selected-option-edit');
            const initialOption = $options.first();
            $selectedOption.html(initialOption.find('.option-image-edit, .option-text-edit').clone());
            $selectedIdInput.val(initialOption.data('value'));

            // Toggle dropdown
            $header.on('click', function(e) {
                e.stopPropagation();
                $select.toggleClass('active');
            });

            // Option selection
            $options.on('click', function() {
                if ($('#total_kg_edit').val() === '') {
                    Swal.fire({
                        icon: 'error',
                        title: '{{ __('word.error') }}',
                        text: '{{ __('word.total_kg_fill_first') }}',
                        confirmButtonText: '{{ __('word.ok') }}'
                    });
                    return;
                }
                const $this = $(this);
                const value = $this.data('value')
                $('#selected_price_id_edit').val(value)
                let totalKg = parseInt($('#total_kg_edit').val());
                $selectedOption.html($this.find('.option-image-edit, .option-text-edit').clone());
                $selectedIdInput.val(value).trigger('change');
                $options.removeClass('selected-edit');
                $this.addClass('selected-edit');
                $select.removeClass('active');
                let totalAmount = Math.round(totalKg * $this.data('price'));
                if (isNaN(totalAmount) || totalAmount < 0) {
                    totalAmount = 0;
                } else {
                    $('#total_amount_edit').val(totalAmount.toLocaleString());
                }
            });

            $(document).on('click', function() {
                $select.removeClass('active');
            });
        });
    });
</script>
