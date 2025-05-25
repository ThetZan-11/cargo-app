<div class="modal fade modal-lg" id="createCustomerModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Customer</h5>
                <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <form id="customer-form">
                                        @csrf
                                        <div data-mdb-input-init class="form-group">
                                            <label class="form-label" for="name">Name</label>
                                            <input type="text" id="name" name="name" class="form-control" />
                                        </div>
                                        <div data-mdb-input-init class="form-group">
                                            <label class="form-label" for="email">Email address</label>
                                            <input type="email" id="email" name="email" class="form-control" />
                                        </div>
                                        <div data-mdb-input-init class="form-group">
                                            <label class="form-label" for="phone">Phone</label>
                                            <input type="text" id="phone" name="phone" class="form-control" />
                                        </div>
                                        <div data-mdb-input-init class="form-group">
                                            <label class="form-label" for="phone2">Phone 2</label>
                                            <input type="te`xt" id="phone2" name="phone2" class="form-control" />
                                        </div>
                                        <div data-mdb-input-init class="form-group">
                                            <label class="form-label" for="address">Address</label>
                                            <textarea class="form-control" id="address" name="address" rows="4"></textarea>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-mdb-ripple-init
                    data-mdb-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" data-mdb-ripple-init>Save changes</button>
                </form>
                {!! JsValidator::formRequest('App\Http\Requests\CustomerCreateRequest', '#customer-form') !!}
            </div>
        </div>
    </div>
</div>
