@extends('layout.app')
@section('title', 'Login')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Login</h2>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <form action="{{ route('auth.login') }}" method="POST" id="login-form" novalidate>
                            @csrf
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="text" id="email" name="email" class="form-control" required />
                                <label class="form-label" for="email">Email address</label>
                                <div class="invalid-feedback">Please enter a valid email address.</div>
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="password" id="password" name="password" class="form-control" required />
                                <label class="form-label" for="password">Password</label>
                                <div class="invalid-feedback">Password is required.</div>
                            </div>

                            <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block mb-4">
                                Sign in
                            </button>
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
            const form = document.getElementById('login-form');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');

            // Email validation function
            function isValidEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }

            // Form validation function
            function validateForm() {
                let isValid = true;

                // Validate email
                if (!emailInput.value) {
                    emailInput.classList.add('is-invalid');
                    emailInput.nextElementSibling.nextElementSibling.textContent = 'Email is required.';
                    isValid = false;
                } else if (!isValidEmail(emailInput.value)) {
                    emailInput.classList.add('is-invalid');
                    emailInput.nextElementSibling.nextElementSibling.textContent =
                        'Please enter a valid email address.';
                    isValid = false;
                } else {
                    emailInput.classList.remove('is-invalid');
                    emailInput.classList.add('is-valid');
                }

                // Validate password
                if (!passwordInput.value) {
                    passwordInput.classList.add('is-invalid');
                    passwordInput.nextElementSibling.nextElementSibling.textContent = 'Password is required.';
                    isValid = false;
                } else if (passwordInput.value.length < 6) {
                    passwordInput.classList.add('is-invalid');
                    passwordInput.nextElementSibling.nextElementSibling.textContent =
                        'Password must be at least 6 characters.';
                    isValid = false;
                } else {
                    passwordInput.classList.remove('is-invalid');
                    passwordInput.classList.add('is-valid');
                }

                return isValid;
            }

            // Real-time validation on input
            emailInput.addEventListener('input', function() {
                if (this.value) {
                    if (isValidEmail(this.value)) {
                        this.classList.remove('is-invalid');
                        this.classList.add('is-valid');
                    } else {
                        this.classList.remove('is-valid');
                        this.classList.add('is-invalid');
                        this.nextElementSibling.nextElementSibling.textContent =
                            'Please enter a valid email address.';
                    }
                } else {
                    this.classList.remove('is-valid');
                    this.classList.add('is-invalid');
                    this.nextElementSibling.nextElementSibling.textContent = 'Email is required.';
                }
            });

            passwordInput.addEventListener('input', function() {
                if (this.value) {
                    if (this.value.length >= 6) {
                        this.classList.remove('is-invalid');
                        this.classList.add('is-valid');
                    } else {
                        this.classList.remove('is-valid');
                        this.classList.add('is-invalid');
                        this.nextElementSibling.nextElementSibling.textContent =
                            'Password must be at least 6 characters.';
                    }
                } else {
                    this.classList.remove('is-valid');
                    this.classList.add('is-invalid');
                    this.nextElementSibling.nextElementSibling.textContent = 'Password is required.';
                }
            });

            // Form submit handler
            form.addEventListener('submit', function(event) {
                if (!validateForm()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
            });

            // Clear validation on focus
            const inputs = [emailInput, passwordInput];
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.classList.remove('is-invalid', 'is-valid');
                });
            });
        });
    </script>
@endsection
