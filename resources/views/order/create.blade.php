<div class="modal fade modal-xl" id="createOrderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('word.order_create') }}</h5>
                <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12 mx-auto">
                                    <form id="order-form">
                                        @csrf
                                        <div class="form-group position-relative">
                                            <label class="form-label"
                                                for="customer_name">{{ __('word.customer_name') }}</label>
                                            <input type="hidden" name="customer_hidden_id" id="customer_hidden_id">
                                            <input type="text" id="customer_name" name="customer_name"
                                                class="form-control" placeholder="{{ __('word.customer_search') }}" />
                                        </div>
                                        <div style="overflow-y: scroll; height: 300px; width: auto; display: none; border-radius:10px; box-shadow: 3px 3px 3px #b9b8b876;"
                                            id="customer-table">
                                            <table class="table-bordered mt-1 table" style=" width: 100%;">
                                                <thead>
                                                    <tr class="table-th text-center">
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
                                            <label class="form-label"
                                                for="various_kg">{{ __('word.various_kg') }}</label>
                                            <input type="text" id="various_kg" name="various_kg" class="form-control"
                                                placeholder="{{ __('word.various_kg_enter') }}" />
                                        </div>
                                        <div class="form-group mt-3">
                                            <label class="form-label" for="country">{{ __('word.price') }}</label>
                                            <div class="custom-image-select">
                                                <div class="select-header">
                                                    <div class="selected-option">
                                                        <span class="option-text">{{ __('word.price_select') }}</span>
                                                    </div>
                                                    <i class="fa-solid fa-down-long" id="select-arrow"></i>
                                                </div>
                                                <div class="select-options">
                                                    @foreach ($prices as $price)
                                                        <div class="option" data-price="{{ $price->price_per_kg }}"
                                                            data-value="{{ $price->id }}">
                                                            <img src="{{ $price->countries->country_flag }}"
                                                                class="option-image">
                                                            <span class="option-text">
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
                                                <input type="hidden" name="selected_price_id" id="selected_price_id"
                                                    value="">
                                            </div>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label class="form-label"
                                                for="min_kg">{{ __('word.various_amount') }}</label>
                                            <input type="text" id="various_amount" name="various_amount"
                                                class="form-control" value="0" />
                                        </div>

                                        <div class="form-group mt-3">
                                            <label class="form-label"
                                                for="order_date">{{ __('word.order_date') }}</label>
                                            <input type="text" id="order_date" name="order_date" class="form-control"
                                                placeholder="{{ __('word.date_enter') }}" />
                                        </div>
                                        <div class="form-group mt-3">
                                            <label class="form-label"
                                                for="sender_name">{{ __('word.sender_name') }}</label>
                                            <input type="text" id="sender_name" name="sender_name"
                                                class="form-control" placeholder="{{ __('word.sender_name') }}" />
                                        </div>
                                        <div class="form-group mt-3">
                                            <label class="form-label"
                                                for="sender_address">{{ __('word.sender_address') }}</label>
                                            <textarea rows="2" id="sender_address" name="sender_address" class="form-control"
                                                placeholder="{{ __('word.enter_sender_address') }}"></textarea>
                                        </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 mx-auto">
                                    <div class="form-group">
                                        <label class="form-label" for="arp_no">ARP NO</label>
                                        <input type="text" id="arp_no" name="arp_no" class="form-control"
                                            placeholder="{{ __('word.arp_no_enter') }}" />
                                    </div>
                                    <div class="form-group mt-3">
                                        <label class="form-label"
                                            for="order_desc">{{ __('word.description') }}</label>
                                        <textarea class="form-control" id="order_desc" placeholder="{{ __('word.enter_desc') }}" name="order_desc"
                                            rows="2"></textarea>
                                    </div>
                                    <div class="row ms-2">
                                        @foreach ($products as $product)
                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                <div class="form-check mt-5">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="{{ $product->name_en }}" value="{{ $product->id }}"
                                                        id="{{ $product->name_en }}" />
                                                    <label class="form-check-label"
                                                        for="{{ $product->name_en }}">{{ App::getLocale() == 'en' ? $product->name_en : $product->name_mm }}</label>
                                                </div>
                                                <div id="{{ $product->name_en }}-container" style="display: none;">
                                                    <div class="form-group d-flex mt-3 gap-2">
                                                        <input type="text" id="{{ $product->name_en }}_kg"
                                                            name="{{ $product->name_en }}_kg" class="form-control"
                                                            placeholder="{{ __('word.enter_kg') }}" />
                                                        @if ($product->name_en != 'box')
                                                            <input type="checkbox"
                                                                name="{{ $product->name_en }}_kg_plus"
                                                                id="{{ $product->name_en }}_kg_plus">
                                                        @endif
                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <input type="text" id="{{ $product->name_en }}_total"
                                                            name="{{ $product->name_en }}_total" class="form-control"
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
        // Initialize select box
        $('.custom-image-select').each(function() {
            const $select = $(this);
            const $header = $select.find('.select-header');
            const $options = $select.find('.option');
            const $selectedIdInput = $select.find('#selected_id');
            const $selectedTextInput = $select.find('#selected_text');
            const $selectedOption = $select.find('.selected-option');
            const initialOption = $options.first();
            $selectedOption.html(initialOption.find('.option-image, .option-text').clone());
            $selectedIdInput.val(initialOption.data('value'));

            // Toggle dropdown
            $header.on('click', function(e) {
                e.stopPropagation();
                $select.toggleClass('active');
            });
            // Option selection
            $options.on('click', function() {
                if ($('#various_kg').val() === '') {
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
                $('#selected_price_id').val(value)
                let totalKg = parseInt($('#various_kg').val());
                $selectedOption.html($this.find('.option-image, .option-text').clone());
                $selectedIdInput.val(value).trigger('change');
                $options.removeClass('selected');
                $this.addClass('selected');
                $select.removeClass('active');
                let totalAmount = Math.round(totalKg * $this.data('price'));
                if (isNaN(totalAmount) || totalAmount < 0) {
                    totalAmount = 0;
                } else {
                    $('#various_amount').val(totalAmount);
                }
            });

            $(document).on('click', function() {
                $select.removeClass('active');
            });
        });
        flatpickr("#order_date", {
            dateFormat: 'Y-m-d',
            altInput: true,
            altFormat: "Y-m-d",
            defaultDate: "today",
            monthSelectorType: "dropdown",
            yearSelectorType: "dropdown",
        });
    });
</script>
