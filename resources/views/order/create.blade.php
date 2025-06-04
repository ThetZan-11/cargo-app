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
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <form id="order-form">
                                        @csrf
                                        <div data-mdb-input-init class="form-group position-relative">
                                            <label class="form-label"
                                                for="customer_name">{{ __('word.customer_name') }}</label>
                                            <input type="hidden" name="customer_hidden_id" id="customer_hidden_id">
                                            <input type="text" id="customer_name" name="customer_name"
                                                class="form-control" placeholder="{{ __('word.customer_search') }}" />
                                            {{-- <i class="fa-solid fa-magnifying-glass"
                                                style="position: absolute; top: 65px; right: 12px; transform: translateY(-50%); color:black;"></i> --}}
                                        </div>
                                        <div style="overflow-y: scroll; height: 250px; width: auto; display: none; border-radius:10px; box-shadow: 3px 3px 3px #b9b8b876;"
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
                                            <label class="form-label" for="country">{{ __('word.price') }}</label>
                                            <select class="form-select" id="price" name="prices"
                                                aria-label="Default select example">
                                                <option selected>{{ __('word.price_select') }}</option>
                                                @foreach ($prices as $price)
                                                    <option value="{{ $price->id }}">
                                                        {{ $price->price_per_kg }} {{ $price->min_kg }}
                                                        {{ $price->max_kg }}
                                                        ({{ $price->countries->country_name }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div data-mdb-input-init class="form-group mt-3">
                                            <label class="form-label"
                                                for="min_kg">{{ __('word.total_amount') }}</label>
                                            <input type="text" id="total_amount" name="total_amount"
                                                class="form-control bg-secondary" disabled value="1"
                                                style="cursor: not-allowed; color:#fff; font-weight: 700;" />
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
                {!! JsValidator::formRequest('App\Http\Requests\PriceCreateRequest', '#price-form') !!}
            </div>
        </div>
    </div>
</div>
