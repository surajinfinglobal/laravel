{{-- =========================================================================
     DevConnect — Navbar Component
     Reusable sticky navigation bar
     ========================================================================= --}}
<nav class="navbar">
    <div class="container-xl">
        {{-- Brand --}}
        <a href="{{ url('/') }}" class="brand">
            <span class="brand-mark"><i class="fa-solid fa-code"></i></span>
            <span class="brand-text">Dev<span>Connect</span></span>
        </a>

        {{-- Desktop Links --}}
        <div class="nav-links">
            <a class="nav-item {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
            <a class="nav-item {{ request()->is('home/project') ? 'active' : '' }}" href="{{ url('home/project') }}">Projects</a>
            <a class="nav-item {{ request()->is('home/pricing') ? 'active' : '' }}" href="{{ url('home/pricing') }}">Pricing</a>
            <a class="nav-item {{ request()->is('home/contact') ? 'active' : '' }}" href="{{ url('home/contact') }}">Contact</a>
            <a class="nav-item {{ request()->is('home/about') ? 'active' : '' }}" href="{{ url('home/about') }}">About</a>
        </div>

        {{-- Right Side Actions --}}
        <div class="navbar-actions">

            @auth
                {{-- Upload Button --}}
                <a href="{{ route('projects.upload') }}" class="btn btn-gradient btn-sm">
                    <i class="fa-solid fa-cloud-arrow-up"></i> Upload Project
                </a>

                {{-- Profile Dropdown --}}
                <div class="profile-dd" id="profileDropdown">
                    <div class="profile-trigger" onclick="toggleProfileMenu(event)">
                        <span>{{ auth()->user()->name ?? 'User' }}</span>
                        <i class="fa-solid fa-chevron-down" style="font-size:.7rem;color:var(--text-muted)"></i>
                    </div>

                    <div class="profile-menu" id="profileMenu">
                        <a href="{{ url('/profile') }}">
                            <i class="fa-regular fa-user"></i> My Profile
                        </a>
                        <a href="{{ url('/dashboard') }}">
                            <i class="fa-solid fa-gauge"></i> Dashboard
                        </a>
                        <a href="{{ url('/home/myproject') }}">
                            <i class="fa-regular fa-folder-open"></i> My Projects
                        </a>
                        <a href="{{ url('/settings') }}">
                            <i class="fa-solid fa-gear"></i> Settings
                        </a>
                        <hr>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="fa-solid fa-right-from-bracket"></i> Logout
                            </a>
                        </form>
                    </div>
                </div>
            @else
                {{-- Guest Buttons --}}
                <a href="{{ route('login') }}" class="btn btn-ghost btn-sm">Login</a>
                <a href="{{ route('signup') }}" class="btn btn-gradient btn-sm">Register</a>
            @endauth

            {{-- Mobile Toggle --}}
            <button class="mobile-toggle" type="button" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
    </div>
</nav>

{{-- Profile Dropdown CSS + JS --}}
<style>
    .profile-dd {
        position: relative;
    }

    .profile-trigger {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 14px;
        border-radius: 50px;
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.1);
        cursor: pointer;
        color: #e2e8f0;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.2s;
        user-select: none;
    }

    .profile-trigger:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: rgba(139, 92, 246, 0.4);
    }

    .profile-menu {
        position: absolute;
        top: calc(100% + 10px);
        right: 0;
        min-width: 200px;
        background: rgba(15, 15, 25, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 14px;
        padding: 8px;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-8px);
        transition: all 0.2s ease;
        z-index: 1000;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
    }

    .profile-menu.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .profile-menu a {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 14px;
        border-radius: 10px;
        color: #cbd5e1;
        font-size: 0.875rem;
        text-decoration: none;
        transition: all 0.15s;
    }

    .profile-menu a:hover {
        background: rgba(139, 92, 246, 0.15);
        color: #c4b5fd;
    }

    .profile-menu a i {
        width: 18px;
        text-align: center;
        opacity: 0.8;
    }

    .profile-menu hr {
        border: none;
        border-top: 1px solid rgba(255, 255, 255, 0.08);
        margin: 6px 0;
    }
</style>

<script>
    function toggleProfileMenu(e) {
        e.stopPropagation();
        const menu = document.getElementById('profileMenu');
        menu.classList.toggle('show');
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function (e) {
        const dropdown = document.getElementById('profileDropdown');
        const menu = document.getElementById('profileMenu');
        if (dropdown && menu && !dropdown.contains(e.target)) {
            menu.classList.remove('show');
        }
    });
</script>