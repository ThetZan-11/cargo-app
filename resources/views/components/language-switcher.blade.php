<div class="language-switcher">
    <a href="{{ route('language.switch', 'en') }}" class="language-btn {{ app()->getLocale() == 'en' ? 'active' : '' }}">
        <i class="fas fa-globe me-2"></i>English
    </a>
    <a href="{{ route('language.switch', 'my') }}" class="language-btn {{ app()->getLocale() == 'my' ? 'active' : '' }}">
        <i class="fas fa-globe me-2"></i>မြန်မာ
    </a>
</div>

<style>
    .language-switcher {
        display: flex;
        gap: 10px;
        padding: 10px;
    }

    .language-btn {
        padding: 8px 15px;
        border-radius: 5px;
        text-decoration: none;
        color: #6c757d;
        transition: all 0.3s ease;
        border: 1px solid #dee2e6;
        background: white;
    }

    .language-btn:hover {
        background: #f8f9fa;
        color: #0d6efd;
        border-color: #0d6efd;
    }

    .language-btn.active {
        background: #0d6efd;
        color: white;
        border-color: #0d6efd;
    }

    /* For dark mode */
    [data-mdb-theme="dark"] .language-btn {
        background: #2b3035;
        color: #adb5bd;
        border-color: #495057;
    }

    [data-mdb-theme="dark"] .language-btn:hover {
        background: #495057;
        color: #fff;
        border-color: #6c757d;
    }

    [data-mdb-theme="dark"] .language-btn.active {
        background: #0d6efd;
        color: white;
        border-color: #0d6efd;
    }
</style>
