<!-- Header -->
@include('layout.partials.header')

@auth
    <!-- Nav and Sidebar for authenticated users -->
    @include('layout.partials.nav')
    @include('layout.partials.aside')

    <div class="container-fluid" id="main-content">
        @yield('content')
    </div>
@else
    <!-- Content only for non-authenticated users -->
    <div class="auth-content">
        @yield('content')
    </div>
@endauth

<!-- Footer -->
@include('layout.partials.footer')
