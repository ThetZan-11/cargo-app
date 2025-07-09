<div class="modal fade modal-lg" id="editCustomerModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('word.customer_edit') }}</h5>
                <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <form id="customer-form-edit">
                                        <input type="hidden" id="edit_id" name="edit_id" />
                                        @csrf
                                        <div  class="form-group">
                                            <label class="form-label"
                                                for="name">{{ __('word.customer_name') }}</label>
                                            <input type="text" id="edit_name" name="edit_name"
                                                class="form-control" />
                                        </div>
                                        <div  class="form-group">
                                            <label class="form-label"
                                                for="email">{{ __('word.customer_email') }}</label>
                                            <input type="email" id="edit_email" name="edit_email"
                                                class="form-control" />
                                        </div>
                                        <div  class="form-group">
                                            <label class="form-label"
                                                for="phone">{{ __('word.customer_phone') }}</label>
                                            <input type="text" id="edit_phone" name="edit_phone"
                                                class="form-control" />
                                        </div>
                                        <div  class="form-group">
                                            <label class="form-label"
                                                for="phone2">{{ __('word.customer_phone2') }}</label>
                                            <input type="text" id="edit_phone2" name="edit_phone2"
                                                class="form-control" />
                                        </div>
                                        <div  class="form-group">
                                            <label class="form-label"
                                                for="address">{{ __('word.customer_address') }}</label>
                                            <textarea class="form-control" id="edit_address" name="edit_address" rows="4"></textarea>
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
                {!! JsValidator::formRequest('App\Http\Requests\CustomerEditRequest', '#customer-form-edit') !!}
            </div>
        </div>
    </div>
</div>
