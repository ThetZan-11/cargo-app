<div class="modal fade modal-lg" id="createPriceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('word.price_create') }}</h5>
                <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <form id="price-form">
                                        @csrf
                                        <div class="form-group">
                                            <label class="form-label" for="country">{{ __('word.country') }}</label>
                                            <select class="form-select" id="country" name="country"
                                                aria-label="Default select example">
                                                <option selected>{{ __('word.select_country') }}</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}">
                                                        {{ $country->country_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div data-mdb-input-init class="form-group mt-3">
                                            <label class="form-label" for="min_kg">{{ __('word.min_kg') }}</label>
                                            <input type="text" id="min_kg" name="min_kg" class="form-control"
                                                placeholder="{{ __('word.min_kg_enter') }}" />
                                        </div>
                                        <div data-mdb-input-init class="form-group mt-3">
                                            <label class="form-label" for="max_kg">{{ __('word.max_kg') }}</label>
                                            <input type="text" id="max_kg" name="max_kg" class="form-control"
                                                placeholder="{{ __('word.max_kg_enter') }}" />
                                        </div>
                                        <div data-mdb-input-init class="form-group mt-3">
                                            <label class="form-label" for="price">{{ __('word.price') }}</label>
                                            <input type="text" id="price" name="price" class="form-control"
                                                placeholder="{{ __('word.price_enter') }}" />
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
