<div class="modal fade modal-lg" id="editCustomerModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Customer</h5>
                <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container mt-3">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <form id="customer-form">
                                        @csrf
                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="text" id="edit_name" name="edit_name"
                                                class="form-control" />
                                            <label class="form-label" for="name">Name</label>
                                        </div>
                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="email" id="edit_email" name="edit_email"
                                                class="form-control" />
                                            <label class="form-label" for="email">Email address</label>
                                        </div>
                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="text" id="edit_phone" name="edit_phone"
                                                class="form-control" />
                                            <label class="form-label" for="phone">Phone</label>
                                        </div>
                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="text" id="edit_phone2" name="edit_phone2"
                                                class="form-control" />
                                            <label class="form-label" for="phone2">Phone 2</label>
                                        </div>
                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <textarea class="form-control" id="edit_address" name="edit_address" rows="4"></textarea>
                                            <label class="form-label" for="address">Address</label>
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
            </div>
        </div>
    </div>
</div>
