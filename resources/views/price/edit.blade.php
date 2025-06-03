<div class="modal fade modal-lg" id="editPriceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('word.price_edit') }}</h5>
                <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <form id="price-form-edit">
                                        @csrf
                                        <input type="hidden" id="edit_id" name="edit_id" />
                                        <div class="form-group">
                                            <label class="form-label"
                                                for="edit_country">{{ __('word.country') }}</label>
                                            <select class="form-select" id="edit_country" name="edit_country"
                                                aria-label="Default select example">
                                                <option selected>{{ __('word.select_country') }}</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}">
                                                        {{ $country->country_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div data-mdb-input-init class="form-group">
                                            <label class="form-label" for="edit_min_kg">{{ __('word.min_kg') }}</label>
                                            <input type="text" id="edit_min_kg" name="edit_min_kg"
                                                class="form-control" />
                                        </div>
                                        <div data-mdb-input-init class="form-group">
                                            <label class="form-label" for="edit_max_kg">{{ __('word.max_kg') }}</label>
                                            <input type="text" id="edit_max_kg" name="edit_max_kg"
                                                class="form-control" />
                                        </div>
                                        <div data-mdb-input-init class="form-group">
                                            <label class="form-label" for="edit_price">{{ __('word.price') }}</label>
                                            <input type="text" id="edit_price" name="edit_price"
                                                class="form-control" />
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
                <button type="submit" class="btn btn-primary" data-mdb-ripple-init>{{ __('word.edit') }}</button>
                </form>
                {!! JsValidator::formRequest('App\Http\Requests\PriceEditRequest', '#price-form-edit') !!}
            </div>
        </div>
    </div>
</div>
