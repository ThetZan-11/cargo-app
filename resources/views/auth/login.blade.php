@extends('layout.app')
@section('title', 'Login')

@section('styles')

@endsection


@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Login</h2>
                        <form id="login-form">
                            @csrf
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="email" id="email" name="email" class="form-control" required />
                                <label class="form-label" for="email">Email address</label>
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="password" id="password" name="password" class="form-control" required />
                                <label class="form-label" for="password">Password</label>
                            </div>

                            <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#login-form').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            
            $.ajax({
                type: 'POST',
                url: "{{ route('auth.login') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status) {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500,
                            fadeIn: 1000,
                        }).then(() => {
                            window.location.href = response.redirect;
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: xhr.responseJSON.message,
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
