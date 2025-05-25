<div class="sidebar">
    <ul class="sidebar-menu">
        <li class="sidebar-menu-item">
            <a href=" {{ route('dashboard') }} ">
                <i class="fa-solid fa-house" id="side-icon"></i>
                Home
            </a>
        </li>
        <li class="sidebar-menu-item">
            <a href="{{ route('customer.index') }}">
                <i class="fa-solid fa-user" id="side-icon"></i>
                Customers
            </a>
        </li>
        <li class="sidebar-menu-item">
            <div class="language-switcher-sidebar">
                <a href="{{ route('language.switch', 'en') }}"
                    class="language-btn {{ app()->getLocale() == 'en' ? 'active' : '' }}">
                    <i class="fa-solid fa-globe" id="side-icon"></i>
                    English
                </a>
                <a href="{{ route('language.switch', 'my') }}"
                    class="language-btn {{ app()->getLocale() == 'my' ? 'active' : '' }}">
                    <i class="fa-solid fa-globe" id="side-icon"></i>
                    မြန်မာ
                </a>
            </div>
        </li>
    </ul>
</div>
