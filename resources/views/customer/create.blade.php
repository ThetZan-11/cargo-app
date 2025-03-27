@extends('layout.app')
@section('title', 'Customers')
@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h2>Customer Create</h2>
                        <form id="customer-form">
                            @csrf
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="text" id="name" name="name" class="form-control" />
                                <label class="form-label" for="name">Name</label>
                            </div>
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="email" id="email" name="email" class="form-control" />
                                <label class="form-label" for="email">Email address</label>
                            </div>
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="text" id="phone" name="phone" class="form-control" />
                                <label class="form-label" for="phone">Phone</label>
                            </div>
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="text" id="phone2" name="phone2" class="form-control" />
                                <label class="form-label" for="phone2">Phone 2</label>
                            </div>
                            <div data-mdb-input-init class="form-outline mb-4">
                                <textarea class="form-control" id="address" name="address" rows="4"></textarea>
                                <label class="form-label" for="address">Address</label>
                            </div>
                            <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block mb-4">Save</button>
                        </form>
                        {!! JsValidator::formRequest('App\Http\Requests\CustomerCreateRequest', '#customer-form') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#customer-form').on('submit', function(e) {
                console.log("submit form");
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('customer.store') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status == 200) {
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1500,
                                fadeIn: 1000,
                            });
                            // window.location.href = "{{ route('customer.index') }}";
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
                    error: function(xhr, status, error) {
                        var errors = xhr.responseJSON.errors;
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
        });
    </script>
@endsection
