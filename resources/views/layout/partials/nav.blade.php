<!-- Navbar-->

<nav class="navbar navbar-expand-lg position-sticky top-0" style="background-color: #dfdf34; z-index: 1000;">
    <div class="container-fluid px-5" id="navbar-content">
        <!-- Left elements -->
        <div class="d-flex">
            <!-- Brand -->
            <a class="navbar-brand me-2 d-flex align-items-center" href="#">
                <img src="{{ asset('assets/img/juu.png') }}" alt="JUU Air Cargo" style="width: 70px; height:70px;" />
            </a>
            <button id="toggle-btn">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
        <!-- Left elements -->

        <!-- Right elements -->
        <ul class="navbar-nav d-flex flex-row align-items-center justify-content-around ms-auto">
            <li class="nav-item">
                <form action="{{ route('auth.logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link text-dark" data-mdb-ripple-init>
                        <i class="fas fa-sign-out-alt"></i> {{ __('word.logout') }}
                    </button>
                </form>
            </li>
            <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link icon" data-bs-toggle="sidebar-right"
                    data-target=".sidebar-right">
                    <i class="fe fe-globe"></i>
                </a>
            </li>
            <li class="nav-item bg-light rounded-5 hover box-shadow-lg">
                <a href="javascript:void(0)" class="nav-link icon" id="theme-toggle">
                    <i class="fa-solid fa-moon dark-icon"></i>
                    <i class="fa-solid fa-sun light-icon"></i>
                </a>
            </li>
        </ul>
        <!-- Right elements -->
    </div>
</nav>

<!-- Navbar -->

<style>
    /* Theme Toggle Styles */
    #theme-toggle {
        position: relative;
        cursor: pointer;
    }

    #theme-toggle .dark-icon,
    #theme-toggle .light-icon {
        transition: all 0.3s ease;
    }

    #theme-toggle .light-icon {
        display: none;
    }

    [data-theme="dark"] #theme-toggle .dark-icon {
        display: none;
    }

    [data-theme="dark"] #theme-toggle .light-icon {
        display: inline-block;
    }

    /* Dark Mode Styles */
    [data-theme="dark"] {
        --bg-color: #1a1d21;
        --text-color: #e4e6eb;
        --sidebar-bg: #242526;
        --card-bg: #242526;
        --border-color: #3e4042;
    }

    [data-theme="dark"] body {
        background-color: var(--bg-color);
        color: var(--text-color);
    }

    [data-theme="dark"] .sidebar {
        background-color: var(--sidebar-bg);
        border-color: var(--border-color);
    }

    [data-theme="dark"] .card {
        background-color: var(--card-bg);
        border-color: var(--border-color);
    }

    [data-theme="dark"] .table {
        color: var(--text-color);
    }

    [data-theme="dark"] .language-btn {
        background: var(--card-bg);
        color: var(--text-color);
        border-color: var(--border-color);
    }

    [data-theme="dark"] .language-btn:hover {
        background: #3e4042;
        color: #fff;
    }

    [data-theme="dark"] .language-btn.active {
        background: #0d6efd;
        color: white;
    }

    @media (max-width: 900px) and (min-width: 576px) {
        .navbar-brand img {
            width: 50px !important;
            height: 50px !important;
        }
        .navbar-brand {
            margin-right: 8px !important;
        }
        .navbar-nav {
            gap: 0.5rem !important;
        }
        .nav-item.bg-light {
            margin-left: 0 !important;
            padding-left: 0 !important;
        }
        .nav-link.icon {
            padding-left: 0.5rem !important;
            padding-right: 0.5rem !important;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const themeToggle = document.getElementById('theme-toggle');
        const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');

        // Check for saved theme preference or use system preference
        const currentTheme = localStorage.getItem('theme') ||
            (prefersDarkScheme.matches ? 'dark' : 'light');

        // Set initial theme
        document.documentElement.setAttribute('data-theme', currentTheme);

        // Toggle theme
        themeToggle.addEventListener('click', function() {
            const currentTheme = document.documentElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';

            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
        });
    });
</script>
