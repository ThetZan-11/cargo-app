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
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12 mx-auto">
                                    <form id="order-form-edit">
                                        @csrf
                                        <input type="hidden" name="order_id_edit" id="order_id_edit" value="">
                                        <div class="form-group position-relative">
                                            <label class="form-label"
                                                for="customer_name_edit">{{ __('word.customer_name') }}</label>
                                            <input type="hidden" name="customer_hidden_id_edit"
                                                id="customer_hidden_id_edit">
                                            <input type="text" id="customer_name_edit" name="customer_name_edit"
                                                class="form-control" placeholder="{{ __('word.customer_search') }}" />
                                        </div>
                                        <div style="overflow-y: scroll; height: 300px; width: auto; display: none; border-radius:10px; box-shadow: 3px 3px 3px #b9b8b876;"
                                            id="customer-table-edit">
                                            <table class="table-bordered mt-1 table" style=" width: 100%;">
                                                <thead>
                                                    <tr class="table-th text-center">
                                                        <th>{{ __('word.customer_name') }}</th>
                                                        <th>{{ __('word.customer_phone') }}</th>
                                                        <th>{{ __('word.customer_address') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="customer-details-edit">

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label class="form-label"
                                                for="various_kg_edit">{{ __('word.various_kg') }}</label>
                                            <input type="text" id="various_kg_edit" name="various_kg_edit"
                                                class="form-control" placeholder="{{ __('word.various_kg_enter') }}" />
                                        </div>
                                        <div class="form-group mt-3">
                                            <label class="form-label" for="country">{{ __('word.price') }}</label>
                                            <div class="custom-image-select-edit" id="custom-image-select-edit">
                                                <div class="select-header-edit">
                                                    <div class="selected-option-edit">
                                                        <span
                                                            class="option-text-edit">{{ __('word.price_select') }}</span>
                                                    </div>
                                                    <i class="fa-solid fa-down-long" id="select-arrow-edit"></i>
                                                </div>
                                                <div class="select-options-edit">
                                                    @foreach ($prices as $price)
                                                        <div class="option-edit"
                                                            data-price="{{ $price->price_per_kg }}"
                                                            data-value="{{ $price->id }}">
                                                            <img src="{{ $price->countries->country_flag }}"
                                                                class="option-image-edit">
                                                            <span class="option-text-edit">
                                                                <span>{{ __('word.min_kg') }} -
                                                                    {{ $price->min_kg }} Kg</span>
                                                                <span>{{ __('word.max_kg') }} -
                                                                    {{ $price->max_kg }} Kg</span>
                                                                <span id="priceEvl">{{ __('word.price') }}
                                                                    -
                                                                    {{ $price->countries->country_code == 'SG' ? $price->price_per_kg : number_format($price->price_per_kg) }}
                                                                    {{ $price->countries->country_code == 'SG' ? " $" : ' MMK' }}</span>
                                                                ({{ $price->countries->country_name }})
                                                            </span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <input type="hidden" name="selected_price_id_edit"
                                                    id="selected_price_id_edit" value="{{ $order->price_id ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label class="form-label"
                                                for="min_kg">{{ __('word.various_amount') }}</label>
                                            <input type="text" id="various_amount_edit" name="various_amount_edit"
                                                class="form-control" value="0" />
                                        </div>

                                        <div class="form-group mt-3">
                                            <label class="form-label"
                                                for="order_date">{{ __('word.order_date') }}</label>
                                            <input type="date" id="order_date_edit" name="order_date_edit"
                                                class="form-control" placeholder="{{ __('word.date_enter') }}" />
                                        </div>
                                        <div class="form-group mt-3">
                                            <label class="form-label"
                                                for="sender_name">{{ __('word.sender_name') }}</label>
                                            <input type="text" id="sender_name_edit" name="sender_name_edit"
                                                class="form-control" placeholder="{{ __('word.sender_name') }}" />
                                        </div>
                                        <div class="form-group mt-3">
                                            <label class="form-label"
                                                for="sender_address">{{ __('word.sender_address') }}</label>
                                            <textarea rows="2" id="sender_address_edit" name="sender_address_edit" class="form-control"
                                                placeholder="{{ __('word.enter_sender_address') }}"></textarea>
                                        </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 mx-auto">
                                    <div class="form-group">
                                        <label class="form-label" for="arp_no">ARP NO</label>
                                        <input type="text" id="arp_no_edit" name="arp_no_edit"
                                            class="form-control" placeholder="{{ __('word.arp_no_enter') }}" />
                                    </div>
                                    <div class="form-group mt-3">
                                        <label class="form-label"
                                            for="order_date">{{ __('word.descrioption') }}</label>
                                        <textarea class="form-control" id="order_desc_edit" placeholder="{{ __('word.enter_desc') }}"
                                            name="order_desc_edit" rows="2"></textarea>
                                    </div>
                                    <div class="row ms-2">
                                        @foreach ($products as $product)
                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                <div class="form-check mt-5">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="{{ $product->name_en }}_edit"
                                                        value="{{ $product->id }}"
                                                        id="{{ $product->name_en }}_edit" />
                                                    <label class="form-check-label"
                                                        for="{{ $product->name_en }}_edit">{{ App::getLocale() == 'en' ? $product->name_en : $product->name_mm }}</label>
                                                </div>
                                                <div id="{{ $product->name_en }}-container-edit"
                                                    style="display: none;">
                                                    <div class="form-group d-flex mt-3 gap-2">
                                                        <input type="text" id="{{ $product->name_en }}_kg_edit"
                                                            name="{{ $product->name_en }}_kg_edit"
                                                            class="form-control"
                                                            placeholder="{{ __('word.enter_kg') }}" />
                                                        @if ($product->name_en != 'box')
                                                            <input type="checkbox"
                                                                name="{{ $product->name_en }}_kg_plus_edit"
                                                                id="{{ $product->name_en }}_kg_plus_edit">
                                                        @endif
                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <input type="text" id="{{ $product->name_en }}_total_edit"
                                                            name="{{ $product->name_en }}_total_edit"
                                                            class="form-control"
                                                            placeholder="{{ __('word.enter_total') }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
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
<script>
    $(document).ready(function() {
        // Initialize select box for edit
        $('#custom-image-select-edit').each(function() {
            const $select = $(this);
            const $header = $select.find('.select-header-edit');
            const $options = $select.find('.option-edit');
            const $selectedIdInput = $select.find('#selected_price_id_edit');
            const $selectedOption = $select.find('.selected-option-edit');
            // Pre-select the current value if available
            const currentValue = $selectedIdInput.val();
            let initialOption = $options.first();
            if (currentValue) {
                const found = $options.filter(function() {
                    return $(this).data('value') == currentValue;
                });
                if (found.length) initialOption = found;
            }
            $selectedOption.html(initialOption.find('.option-image-edit, .option-text-edit').clone());
            $selectedIdInput.val(initialOption.data('value'));

            // Toggle dropdown
            $header.on('click', function(e) {
                e.stopPropagation();
                $select.toggleClass('active');
            });

            // Option selection
            $options.on('click', function() {
                if ($('#various_kg_edit').val() === '') {
                    Swal.fire({
                        icon: 'error',
                        title: '{{ __('word.error') }}',
                        text: '{{ __('word.various_kg_fill_first') }}',
                        confirmButtonText: '{{ __('word.ok') }}'
                    });
                    return;
                }
                const $this = $(this);
                const value = $this.data('value')
                $('#selected_price_id_edit').val(value)
                let totalKg = parseInt($('#various_kg_edit').val());
                $selectedOption.html($this.find('.option-image-edit, .option-text-edit')
                    .clone());
                $selectedIdInput.val(value).trigger('change');
                $options.removeClass('selected-edit');
                $this.addClass('selected-edit');
                $select.removeClass('active');
                let totalAmount = Math.round(totalKg * $this.data('price'));
                if (isNaN(totalAmount) || totalAmount < 0) {
                    totalAmount = 0;
                } else {
                    $('#various_amount_edit').val(totalAmount);
                }
            });

            $(document).on('click', function() {
                $select.removeClass('active');
            });
        });
    });
</script>
