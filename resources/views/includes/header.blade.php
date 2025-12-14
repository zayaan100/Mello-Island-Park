<header id="main-header" class="shadow-sm">
    <style>
        /* ====== PREMIUM NAVBAR STYLE ====== */
        #main-header {
            background: #fff;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .navbar-mellow {
            background: #fff;
            padding: 16px 4%;
        }

        .navbar-mellow .navbar-brand img {
            height: 52px;
        }

        /* Center nav links */
        .navbar-mellow .navbar-nav {
            gap: 10px;
        }

        .nav-link-premium {
            position: relative;
            font-weight: 500;
            font-size: 16px;
            color: #222 !important;
            padding: 4px 14px !important;
        }

        .nav-link-premium:hover {
            color: #000 !important;
        }

        /* underline animation */
        .nav-link-premium::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -4px;
            width: 0;
            height: 2px;
            background: #f2a36b;
            transition: width 0.25s ease;
        }

        .nav-link-premium:hover::after,
        .nav-link-premium.active::after {
            width: 100%;
        }

        /* Right side buttons */
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-nav-ghost {
            background: #fff;
            border-radius: 999px;
            border: 1px solid #e2d7cf;
            padding: 8px 18px;
            font-weight: 600;
            font-size: 14px;
            color: #333;
            transition: 0.2s;
        }

        .btn-nav-ghost:hover {
            background: #f7f2ee;
            border-color: #d0bfb3;
            color: #111;
        }

        .btn-nav-primary {
            background: #f7f2ee;
            border-radius: 999px;
            border: 1px solid #e2d7cf;
            padding: 8px 20px;
            font-weight: 600;
            font-size: 14px;
            color: #222;
            transition: 0.2s;
        }

        .btn-nav-primary:hover {
            background: #e9dfd8;
            border-color: #d0bfb3;
            color: #111;
        }

        /* mobile tweaks */
        @media (max-width: 991.98px) {
            .navbar-mellow {
                padding: 10px 3%;
            }
            .nav-actions {
                margin-top: 10px;
            }
        }
    </style>

    <nav class="navbar navbar-expand-lg navbar-light navbar-mellow">
        <div class="container-fluid">

            {{-- Logo --}}
            <a href="{{ route('landing') }}" class="navbar-brand">
                <img src="{{ asset('images/main-logo.png') }}" alt="Mellow Island Park">
            </a>

            {{-- Mobile toggler --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#mainNavbar" aria-controls="mainNavbar"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- Nav + Actions --}}
            <div class="collapse navbar-collapse" id="mainNavbar">
                {{-- Center nav links --}}
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a href="{{ route('landing') }}#hero"
                           class="nav-link nav-link-premium">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('landing') }}#about-us"
                           class="nav-link nav-link-premium">
                            About
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('landing') }}#rooms"
                           class="nav-link nav-link-premium">
                            Rooms
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('landing') }}#activities"
                           class="nav-link nav-link-premium">
                            Activities
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('landing') }}#spa"
                           class="nav-link nav-link-premium">
                            Spa
                        </a>
                    </li>
                    {{-- 🔥 Contact removed completely as you requested --}}
                </ul>

                {{-- Right side auth / dashboard / logout --}}
                <div class="nav-actions">
                    @guest
                        <a href="{{ route('login') }}" class="btn-nav-ghost">Login</a>
                        <a href="{{ route('register') }}" class="btn-nav-primary">Register</a>
                    @else
                        @php $role = Auth::user()->role; @endphp

                        @if($role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="btn-nav-ghost">
                                Admin Dashboard
                            </a>
                        @elseif($role === 'staff')
                            <a href="{{ route('staff.dashboard') }}" class="btn-nav-ghost">
                                Staff Panel
                            </a>
                        @elseif($role === 'customer')
                            <a href="{{ route('customer.dashboard') }}" class="btn-nav-ghost">
                                My Dashboard
                            </a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn-nav-primary">
                                Logout
                            </button>
                        </form>
                    @endguest
                </div>
            </div>

        </div>
    </nav>
</header>
