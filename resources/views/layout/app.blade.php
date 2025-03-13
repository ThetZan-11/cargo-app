<!-- Sidebar -->
@include('layout.partials.header')
{{-- @php
    $isAuthPage = in_array(Route::currentRouteName(), ['auth.loginPage']);
@endphp
@if (!$isAuthPage) --}}
@include('layout.partials.nav')
@include('layout.partials.aside')

<div class="">
    @yield('content')
</div>
{{-- @else
    <div>
        @yield('content')
    </div>
@endif --}}

<!-- Footer -->
@include('layout.partials.footer')
