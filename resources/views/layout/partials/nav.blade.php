<!-- Navbar-->

<nav class="navbar navbar-expand-lg" style="background-color: #dfdf34;">
    <div class="container-fluid justify-content-between align-items-center">
        <!-- Left elements -->
        <div class="d-flex">
            <!-- Brand -->
            <a class="navbar-brand me-2 mb-1 d-flex align-items-center" href="#">
                <img src="{{ asset('assets/img/juu.png') }}" alt="JUU Air Cargo"
                    style="width: 100px; height:100px; border-radius:50%;" />
            </a>
            <button id="toggle-btn">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
        <!-- Left elements -->

        <!-- Right elements -->
        <ul class="navbar-nav flex-row align-items-center">
            <li class="nav-item me-3 me-lg-1">
                <a class="nav-link d-sm-flex align-items-sm-center" href="#">
                    <img src="https://mdbcdn.b-cdn.net/img/new/avatars/1.webp" class="rounded-circle" height="22"
                        alt="Black and White Portrait of a Man" loading="lazy" />
                    {{-- <strong class="d-none d-sm-block ms-1">{{ Auth::user()->name }}</strong> --}}
                </a>
            </li>
            <li class="nav-item">
                <form action="{{ route('auth.logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link text-dark" data-mdb-ripple-init>
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
        <!-- Right elements -->
    </div>
</nav>

<!-- Navbar -->
