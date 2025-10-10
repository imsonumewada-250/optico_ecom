<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopeerWait - Advanced Layout</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
        }

        /* ========== ADVANCED NAVBAR ========== */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.4s ease;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: 1px;
            position: relative;
            padding: 5px 0;
        }

        .navbar-brand::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 3px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: width 0.3s ease;
        }

        .navbar-brand:hover::after {
            width: 100%;
        }

        .nav-link {
            color: #2d3748 !important;
            font-weight: 500;
            margin: 0 8px;
            padding: 8px 16px !important;
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: left 0.3s ease;
            z-index: -1;
            border-radius: 8px;
        }

        .nav-link:hover {
            color: #fff !important;
            transform: translateY(-2px);
        }

        .nav-link:hover::before {
            left: 0;
        }

        /* Cart Icon with Animation */
        .cart-icon {
            position: relative;
            color: #2d3748;
            transition: all 0.3s ease;
        }

        .cart-icon:hover {
            transform: scale(1.1);
        }

        .cart-icon .badge {
            position: absolute;
            top: -8px;
            right: -10px;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            font-size: 11px;
            padding: 4px 7px;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        /* Auth Buttons */
        .btn-login {
            background: transparent;
            border: 2px solid #667eea;
            color: #667eea;
            padding: 8px 24px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 8px 24px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.5);
        }

        /* Profile Dropdown */
        .profile-img {
            width: 38px;
            height: 38px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #667eea;
            transition: all 0.3s ease;
        }

        .profile-img:hover {
            border-color: #764ba2;
            transform: scale(1.05);
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            border-radius: 12px;
            padding: 10px;
            margin-top: 10px;
        }

        .dropdown-item {
            border-radius: 8px;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: translateX(5px);
        }

        /* ========== ADVANCED FOOTER ========== */
        footer {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #1e3c72 100%);
            color: #fff;
            margin-top: 60px;
            position: relative;
            overflow: hidden;
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.05" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,138.7C960,139,1056,117,1152,101.3C1248,85,1344,75,1392,69.3L1440,64L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>');
            background-size: cover;
        }

        .footer-content {
            position: relative;
            z-index: 1;
            padding: 50px 0 30px;
        }

        .footer-brand {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 15px;
            background: linear-gradient(135deg, #fff 0%, #f093fb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .footer-description {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.95rem;
            max-width: 300px;
            margin: 0 auto 20px;
        }

        .footer-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }

        .footer-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            border-radius: 2px;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .footer-links a:hover {
            color: #fff;
            transform: translateX(5px);
        }

        .footer-links a i {
            margin-right: 8px;
            color: #f093fb;
        }

        /* Social Icons */
        .social-icons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 20px;
        }

        .social-icon {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            backdrop-filter: blur(5px);
        }

        .social-icon:hover {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            transform: translateY(-5px) rotate(360deg);
            box-shadow: 0 5px 20px rgba(240, 147, 251, 0.5);
        }

        /* Newsletter */
        .newsletter-form {
            display: flex;
            max-width: 400px;
            margin: 20px auto 0;
            gap: 10px;
        }

        .newsletter-input {
            flex: 1;
            padding: 12px 20px;
            border: none;
            border-radius: 25px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            color: white;
            outline: none;
        }

        .newsletter-input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .newsletter-btn {
            padding: 12px 30px;
            border: none;
            border-radius: 25px;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .newsletter-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 20px rgba(240, 147, 251, 0.5);
        }

        /* Footer Bottom */
        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 25px 0;
            margin-top: 40px;
            text-align: center;
        }

        .footer-bottom p {
            margin: 0;
            color: rgba(255, 255, 255, 0.8);
        }

        .footer-bottom a {
            color: #f093fb;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-bottom a:hover {
            color: #fff;
            text-decoration: underline;
        }

        /* Main Content Demo */
        .demo-content {
            min-height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .demo-card {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- ========== NAVBAR ========== -->
    <nav class="navbar navbar-expand-lg sticky-top" id="mainNavbar">
        <div class="container">
            <!-- Brand Logo -->
            <a class="navbar-brand" href="#">
                ShopeerWait
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Shop</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Categories</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Deals</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>

                    <!-- Cart -->
                    <li class="nav-item ms-2">
                        <a class="nav-link cart-icon" href="#">
                            <i class="bi bi-cart3 fs-4"></i>
                            <span class="badge">3</span>
                        </a>
                    </li>

                    <!-- Auth Buttons (Guest) -->
                    <li class="nav-item ms-3">
                        <a href="#" class="btn btn-login">Login</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a href="#" class="btn btn-register">Register</a>
                    </li>

                    <!-- User Dropdown (Logged In - Hidden by default) -->
                    <!-- <li class="nav-item dropdown ms-3" style="display:none;">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <img src="https://ui-avatars.com/api/?name=User&background=667eea&color=fff" alt="User" class="profile-img">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> My Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-bag"></i> My Orders</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-heart"></i> Wishlist</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                        </ul>
                    </li> -->
                </ul>
            </div>
        </div>
    </nav>

    <!-- ========== MAIN CONTENT (Demo) ========== -->
     <main>
        @yield('content')
    </main>

    <!-- ========== FOOTER ========== -->
    <footer>
        <div class="footer-content">
            <div class="container">
                <div class="row">
                    <!-- Column 1: Brand & Description -->
                    <div class="col-md-4 text-center text-md-start mb-4">
                        <h2 class="footer-brand">ShopeerWait</h2>
                        <p class="footer-description">
                            Your trusted destination for quality products and exceptional service. Shop with confidence!
                        </p>
                        <div class="social-icons">
                            <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="social-icon"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="social-icon"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>

                    <!-- Column 2: Quick Links -->
                    <div class="col-md-2 mb-4">
                        <h5 class="footer-title">Quick Links</h5>
                        <ul class="footer-links">
                            <li><a href="#"><i class="bi bi-chevron-right"></i> About Us</a></li>
                            <li><a href="#"><i class="bi bi-chevron-right"></i> Shop</a></li>
                            <li><a href="#"><i class="bi bi-chevron-right"></i> Blog</a></li>
                            <li><a href="#"><i class="bi bi-chevron-right"></i> Contact</a></li>
                        </ul>
                    </div>

                    <!-- Column 3: Customer Service -->
                    <div class="col-md-3 mb-4">
                        <h5 class="footer-title">Customer Service</h5>
                        <ul class="footer-links">
                            <li><a href="#"><i class="bi bi-chevron-right"></i> Track Order</a></li>
                            <li><a href="#"><i class="bi bi-chevron-right"></i> Returns</a></li>
                            <li><a href="#"><i class="bi bi-chevron-right"></i> Shipping Info</a></li>
                            <li><a href="#"><i class="bi bi-chevron-right"></i> FAQ</a></li>
                        </ul>
                    </div>

                    <!-- Column 4: Newsletter -->
                    <div class="col-md-3 mb-4">
                        <h5 class="footer-title">Newsletter</h5>
                        <p style="color: rgba(255, 255, 255, 0.8); font-size: 0.9rem;">
                            Subscribe to get special offers and updates!
                        </p>
                        <form class="newsletter-form">
                            <input type="email" class="newsletter-input" placeholder="Your email">
                            <button type="submit" class="newsletter-btn">
                                <i class="bi bi-send"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="container">
                <p>
                    © 2025 <strong>ShopeerWait</strong>. All rights reserved. |
                    <a href="#">Privacy Policy</a> |
                    <a href="#">Terms & Conditions</a>
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('mainNavbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>