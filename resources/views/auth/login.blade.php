@extends('layout.app')
@section('title', 'Login')

@section('styles')

@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="login-container d-flex justify-content-center align-items-center">
                    <div class="col-12 col-lg-6 col-md-8 col-sm-12 mx-auto login-card">
                        <h1 class="mb-3">Login</h1>
                        <form>
                            <div data-mdb-input-init class="form-outline mb-4 login-input">
                                <input type="email" id="email" class="form-control" />
                                <label class="form-label" for="email">Email address</label>
                            </div>
                            <div data-mdb-input-init class="form-outline mb-4 login-input">
                                <input type="password" id="password" class="form-control" />
                                <label class="form-label" for="password">Password</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                                <label class="form-check-label" for="form1Example3"> Remember me </label>
                            </div>
                            <div>
                                <button data-mdb-ripple-init type="submit"
                                    class="btn btn-cargo btn-block py-2">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
