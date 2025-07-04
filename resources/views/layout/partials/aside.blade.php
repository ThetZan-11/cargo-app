<div class="sidebar">
    <ul class="sidebar-menu">
        <li class="sidebar-menu-item">
            <a href=" {{ route('dashboard') }} ">
                <i class="fa-solid fa-house" id="side-icon"></i>
                {{ __('word.dashboard') }}
            </a>
        </li>
        <li class="sidebar-menu-item">
            <a href="{{ route('customer.index') }}">
                <i class="fa-solid fa-people-group" id="side-icon"></i>
                {{ __('word.customer') }}
            </a>
        </li>
        <li class="sidebar-menu-item">
            <a href="{{ route('country.index') }}">
                <i class="fa-solid fa-earth-americas" id="side-icon"></i>
                {{ __('word.country') }}
            </a>
        </li>
        <li class="sidebar-menu-item">
            <a href="{{ route('price.index') }}">
                <i class="fa-solid fa-coins" id="side-icon"></i>
                {{ __('word.price') }}
            </a>
        </li>
        <li class="sidebar-menu-item">
            <a href="{{ route('order.index') }}">
                <i class="fa-solid fa-boxes-packing" id="side-icon"></i>
                {{ __('word.order') }}
            </a>
        </li>
        <li class="sidebar-menu-item">
            <div class="language-switcher-sidebar">
                <a href="{{ route('language.switch', 'en') }}"
                    class="language-btn {{ app()->getLocale() == 'en' ? 'active' : '' }}">
                    <img src="{{ asset('assets/img/usa.png') }}" alt="USA Flag" class="img-fluid w-25 me-3">
                    English
                </a>
                <a href="{{ route('language.switch', 'my') }}"
                    class="language-btn {{ app()->getLocale() == 'my' ? 'active' : '' }}">
                    <img src="{{ asset('assets/img/myanmar.png') }}" alt="Myanmar Flag" class="img-fluid w-25 me-3">
                    မြန်မာ
                </a>
            </div>
        </li>
    </ul>
</div>
