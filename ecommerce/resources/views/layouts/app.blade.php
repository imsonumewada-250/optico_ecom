<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - ShopeerWait</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Poppins', sans-serif;
        }
       .navbar {
  background: linear-gradient(90deg,
    #99bfd2ff 0%,   /* light sky blue */
    #92d1baff 50%,  /* mint green */
    #c0f5e1 100%  /* aqua tint */
  );
  transition: all 0.4s ease;
  border-bottom: 1px solid rgba(255,255,255,0.2);
}

        .navbar-brand {
            font-weight: 1000;
            color: #5e5444ff !important;
            letter-spacing: 0.5px;
        }
        .nav-link {
            color: #fff !important;
            font-weight: 500;
            margin-right: 10px;
            transition: 0.3s;
        }
        .nav-link:hover {
            color: #ffe082 !important;
        }
        .cart-icon {
            position: relative;
            color: #fff;
        }
        .cart-icon span {
            position: absolute;
            top: -8px;
            right: -10px;
            background: #ff3d00;
            color: white;
            font-size: 12px;
            padding: 2px 5px;
            border-radius: 50%;
        }
        footer {
            background: #1a1a1a;
            color: #ccc;
            margin-top: 60px;
        }
        footer a {
            color: #999;
            text-decoration: none;
        }
        footer a:hover {
            color: #fff;
        }
        /* Profile Image */
        .profile-img {
            width: 35px;
            height: 35px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #fff;
        }
    </style>
</head>

<body>
    <!-- 🌐 Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm sticky-top">
        <div class="container">
            <!-- Brand Logo -->
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <!-- <img src="{{ asset('images/logo.png') }}" alt="Logo" width="40" height="40" class="me-2 rounded-circle"> -->
                <span>ShopeerWait</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">

                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Shop</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>

                    <!-- Cart -->
                    <li class="nav-item ms-2">
                        <a class="nav-link cart-icon" href="#">
                            <i class="bi bi-cart3 fs-5"></i>
                            <span>2</span> {{-- Replace 2 with dynamic cart count --}}
                        </a>
                    </li>

                    <!-- Auth Links -->
                    @guest
                        <li class="nav-item ms-3">
                            <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Login</a>
                        </li>
                        <li class="nav-item ms-2">
                            <a href="{{ route('register') }}" class="btn btn-light btn-sm">Register</a>
                        </li>
                    @else
                        <li class="nav-item dropdown ms-3">
                            <a class="nav-link dropdown-toggle text-white d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <!-- Profile Photo instead of name -->
                                <!-- <img src="{{ asset(Auth::user()->photo ?? 'images/default-user.png') }}"  -->
                                     <!-- alt="User"
                                     class="profile-img me-2">
                            </a> -->
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                <li><a class="dropdown-item" href="#">My Profile</a></li>
                                <li><a class="dropdown-item" href="#">My Orders</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="alert alert-success text-center m-0 py-2">
            {{ session('success') }}
        </div>
    @endif

    <!-- Main Content -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="text-center py-4">
        <div class="container">
            <p>© 2025 ShopeerWait. All rights reserved.</p>
            <small>
                <a href="#">Privacy Policy</a> |
                <a href="#">Terms & Conditions</a>
            </small>
        </div>
    </footer>
</body>
</html>
