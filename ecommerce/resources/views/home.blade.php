@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Link to external CSS file -->
<link rel="stylesheet" href="{{ asset('css/home.css') }}">

<div class="container mt-4">

    <!-- 🏆 FEATURED CAROUSEL -->
    <div class="custom-carousel">
        <div class="carousel-track">
            <img src="{{ asset('images/boxnew02.jpg') }}" alt="Banner 1" class="carousel-img">
            <img src="{{ asset('images/boxnew01.jpg') }}" alt="Banner 2" class="carousel-img">
            <img src="{{ asset('images/boxnew03.jpg') }}" alt="Banner 3" class="carousel-img">
        </div>

        <button class="carousel-btn prev">&#10094;</button>
        <button class="carousel-btn next">&#10095;</button>
    </div>

    <!-- ✨ CATEGORY FILTER -->
    <div class="container mx-auto py-10">
        <h1 class="category-header">Explore Our Collections</h1>

        <div class="category-filters">
            <a href="#"
               data-category=""
               class="category-btn {{ !$categorySlug ? 'active' : 'inactive' }}">
                All
            </a>

            @foreach ($categories as $cat)
                <a href="#"
                   data-category="{{ $cat->slug }}"
                   class="category-btn {{ $categorySlug == $cat->slug ? 'active' : 'inactive' }}">
                    {{ ucfirst($cat->name) }}
                </a>
            @endforeach
        </div>

        <!-- 🛍️ PRODUCT GRID -->
        <div class="product-grid" id="productGrid">
            @forelse ($products as $product)
                <div class="product-card" data-category="{{ $product->category->slug }}">
                    <div class="product-image-wrapper">
                        <img src="{{ asset('storage/'.$product->image) }}"
                             alt="{{ $product->name }}"
                             class="product-image">

                        <div class="wishlist-btn">
                            <i class="bi bi-heart"></i>
                        </div>
                    </div>

                    <div class="product-content">
                        <h3 class="product-name">{{ $product->name }}</h3>
                        <p class="product-category">{{ $product->category->name }}</p>
                        <div class="product-footer">
                            <span class="product-price">₹{{ number_format($product->price, 2) }}</span>
                            <button class="view-btn">View</button>
                        </div>
                    </div>
                </div>
            @empty
                <p class="no-products">No products found.</p>
            @endforelse
        </div>

        <!-- Loading Spinner -->
        <div id="loadingSpinner" class="loading-spinner" style="display: none;">
            <div class="spinner"></div>
        </div>
    </div>

    <!-- 💬 TESTIMONIALS -->
    <section class="testimonials-section">
        <h4 class="testimonials-title">What Our Customers Say</h4>
        <div class="testimonials-grid">
            <div class="testimonial">
                <p>"Amazing quality and super fast delivery!"</p>
                <strong>- Priya Sharma</strong>
            </div>
            <div class="testimonial">
                <p>"Best e-commerce experience I've had so far."</p>
                <strong>- Rahul Mehta</strong>
            </div>
            <div class="testimonial">
                <p>"Customer support was extremely helpful."</p>
                <strong>- Neha Patel</strong>
            </div>
        </div>
    </section>
</div>

<!-- 🎬 JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    // ============================================
    // CAROUSEL LOGIC
    // ============================================
    let index = 0;
    const track = document.querySelector('.carousel-track');
    const slides = document.querySelectorAll('.carousel-img');
    const total = slides.length;

    function nextSlide() {
        index = (index + 1) % total;
        track.style.transform = `translateX(-${index * 100}%)`;
    }

    function prevSlide() {
        index = (index - 1 + total) % total;
        track.style.transform = `translateX(-${index * 100}%)`;
    }

    document.querySelector('.next').addEventListener('click', nextSlide);
    document.querySelector('.prev').addEventListener('click', prevSlide);

    let autoSlide = setInterval(nextSlide, 3000);

    track.addEventListener('mouseenter', () => clearInterval(autoSlide));
    track.addEventListener('mouseleave', () => {
        autoSlide = setInterval(nextSlide, 3000);
    });

    // ============================================
    // CATEGORY FILTER - WITHOUT PAGE RELOAD
    // ============================================
    const categoryButtons = document.querySelectorAll('.category-btn');
    const productGrid = document.getElementById('productGrid');
    const loadingSpinner = document.getElementById('loadingSpinner');

    categoryButtons.forEach(button => {
        // Click Event - Load Products
        button.addEventListener('click', function(e) {
            e.preventDefault();

            const category = this.getAttribute('data-category');

            // Update active state
            categoryButtons.forEach(btn => {
                btn.classList.remove('active');
                btn.classList.add('inactive');
            });
            this.classList.remove('inactive');
            this.classList.add('active');

            // Load products via AJAX
            loadProducts(category);
        });

        // Hover Event - Preview Products
        button.addEventListener('mouseenter', function() {
            if (!this.classList.contains('active')) {
                const category = this.getAttribute('data-category');
                previewProducts(category);
            }
        });

        button.addEventListener('mouseleave', function() {
            if (!this.classList.contains('active')) {
                // Show all products again
                const allProducts = document.querySelectorAll('.product-card');
                allProducts.forEach(card => {
                    card.style.opacity = '1';
                    card.style.transform = 'scale(1)';
                });
            }
        });
    });

    // Function to load products (AJAX)
    function loadProducts(category) {
        // Show loading
        productGrid.style.opacity = '0.5';
        loadingSpinner.style.display = 'flex';

        const url = category ? `{{ route('home') }}?category=${category}` : `{{ route('home') }}`;

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            // Parse the HTML response
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newProducts = doc.querySelector('#productGrid').innerHTML;

            // Update products with animation
            productGrid.style.opacity = '0';

            setTimeout(() => {
                productGrid.innerHTML = newProducts;
                productGrid.style.opacity = '1';
                loadingSpinner.style.display = 'none';

                // Re-animate product cards
                const cards = productGrid.querySelectorAll('.product-card');
                cards.forEach((card, idx) => {
                    card.style.animation = 'none';
                    setTimeout(() => {
                        card.style.animation = `fadeInUp 0.6s ease ${idx * 0.1}s forwards`;
                    }, 10);
                });
            }, 300);

            // Update URL without reload
            const newUrl = category ? `{{ route('home') }}?category=${category}` : `{{ route('home') }}`;
            window.history.pushState({}, '', newUrl);
        })
        .catch(error => {
            console.error('Error loading products:', error);
            loadingSpinner.style.display = 'none';
            productGrid.style.opacity = '1';
        });
    }

    // Function to preview products on hover
    function previewProducts(category) {
        const allProducts = document.querySelectorAll('.product-card');

        if (category === '') {
            // Show all products
            allProducts.forEach(card => {
                card.style.opacity = '1';
                card.style.transform = 'scale(1)';
                card.style.filter = 'none';
            });
        } else {
            // Highlight matching category, dim others
            allProducts.forEach(card => {
                const productCategory = card.getAttribute('data-category');

                if (productCategory === category) {
                    card.style.opacity = '1';
                    card.style.transform = 'scale(1.05)';
                    card.style.filter = 'none';
                } else {
                    card.style.opacity = '0.3';
                    card.style.transform = 'scale(0.95)';
                    card.style.filter = 'grayscale(50%)';
                }
            });
        }
    }
});
</script>

<!-- 🌍 Brand Showcase Section -->
<section class="brand-section">
    <div class="brand-container">
        <h2 class="section-title">Our Trusted Partners</h2>
        <p class="section-subtitle">We collaborate with globally recognized brands that redefine quality and innovation in their respective industries.</p>

        <div class="brand-grid">
            <div class="brand-card" onclick="showBrandInfo('toyota')">
                <div class="logo-container">
                    <img src="{{ asset('images/brands/logo01.jpg') }}" alt="Toyota">
                </div>
                <h5>Toyota</h5>
            </div>

            <div class="brand-card" onclick="showBrandInfo('lg')">
                <div class="logo-container">
                    <img src="{{ asset('images/brands/logo02.png') }}" alt="LG">
                </div>
                <h5>LG</h5>
            </div>

            <div class="brand-card" onclick="showBrandInfo('croma')">
                <div class="logo-container">
                    <img src="{{ asset('images/brands/croma.png') }}" alt="Croma">
                </div>
                <h5>Croma</h5>
            </div>

            <div class="brand-card" onclick="showBrandInfo('prince')">
                <div class="logo-container">
                    <img src="{{ asset('images/brands/logo06.jpg') }}" alt="Prince Jewellery">
                </div>
                <h5>Prince Jewellery</h5>
            </div>
        </div>

        <!-- 🧩 Brand Info Box -->
        <div id="brand-info" class="brand-info">
            <p class="placeholder-text">✨ Click on a brand to explore detailed insights and success stories</p>
        </div>
    </div>
</section>

<style>
/* 🌟 Modern Section Layout */
.brand-section {
    background: linear-gradient(135deg, #1a1f3a 0%, #0f1729 100%);
    color: #fff;
    padding: 80px 40px;
    border-radius: 30px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
    position: relative;
    overflow: hidden;
    margin-top: 60px;
}

.brand-section::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(0, 212, 255, 0.1) 0%, transparent 70%);
    animation: pulse 8s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); opacity: 0.5; }
    50% { transform: scale(1.2); opacity: 0.8; }
}

.brand-container {
    max-width: 1200px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
}

.section-title {
    font-size: 2.8rem;
    font-weight: 800;
    margin-bottom: 15px;
    background: linear-gradient(135deg, #00d4ff 0%, #7b2ff7 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-align: center;
    letter-spacing: -1px;
}

.section-subtitle {
    font-size: 1.1rem;
    color: #a0b4d4;
    margin-bottom: 60px;
    text-align: center;
    max-width: 700px;
    margin-left: auto;
    margin-right: auto;
}

/* 🎨 Brand Grid */
.brand-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 30px;
    justify-items: center;
    margin-bottom: 60px;
    max-width: 1000px;
    margin-left: auto;
    margin-right: auto;
}

.brand-card {
    background: linear-gradient(145deg, rgba(255, 255, 255, 0.08), rgba(255, 255, 255, 0.03));
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    padding: 30px 20px;
    text-align: center;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    cursor: pointer;
    width: 200px;
    height: 200px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.brand-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(0, 212, 255, 0.2), rgba(123, 47, 247, 0.2));
    opacity: 0;
    transition: opacity 0.4s ease;
}

.brand-card:hover::before {
    opacity: 1;
}

.brand-card:hover {
    transform: translateY(-15px) scale(1.05);
    border-color: rgba(0, 212, 255, 0.5);
    box-shadow: 0 20px 40px rgba(0, 212, 255, 0.3),
                0 0 60px rgba(123, 47, 247, 0.2);
}

/* Logo Container with Fixed Design */
.logo-container {
    width: 130px;
    height: 130px;
    background: #ffffff;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 15px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    transition: transform 0.4s ease;
    padding: 15px;
}

.brand-card:hover .logo-container {
    transform: scale(1.1) rotate(5deg);
}

.logo-container::after {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.3) 50%, transparent 70%);
    transform: rotate(45deg);
    animation: shine 3s infinite;
}

@keyframes shine {
    0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
    100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
}

.brand-logo {
    width: 100%;
    height: 100%;
    position: relative;
    z-index: 1;
}

.logo-container img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    position: relative;
    z-index: 1;
}

.brand-card h5 {
    color: #fff;
    font-size: 1.1rem;
    font-weight: 600;
    margin: 0;
    letter-spacing: 0.5px;
    position: relative;
    z-index: 1;
}

/* 🎭 Brand Info Box - Glassmorphism */
.brand-info {
    background: linear-gradient(145deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
    backdrop-filter: blur(20px);
    padding: 40px 35px;
    border-radius: 25px;
    border: 2px solid rgba(255, 255, 255, 0.15);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3),
                inset 0 0 20px rgba(255, 255, 255, 0.05);
    transition: all 0.4s ease;
    min-height: 300px;
}

.brand-info h4 {
    font-size: 2rem;
    background: linear-gradient(135deg, #00d4ff 0%, #7b2ff7 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 20px;
    font-weight: 700;
}

.brand-info p {
    color: #cbd5e1;
    font-size: 1.05rem;
    line-height: 1.7;
    margin-bottom: 25px;
}

.brand-info ul {
    list-style: none;
    padding: 0;
    margin-bottom: 25px;
}

.brand-info ul li {
    margin: 15px 0;
    font-size: 1rem;
    color: #e2e8f0;
    padding-left: 35px;
    position: relative;
    line-height: 1.6;
}

.brand-info ul li::before {
    content: "✦";
    position: absolute;
    left: 0;
    color: #00d4ff;
    font-size: 1.3rem;
    font-weight: bold;
}

.read-more {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: linear-gradient(135deg, #00d4ff 0%, #0099cc 100%);
    color: #000;
    padding: 12px 30px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 700;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(0, 212, 255, 0.3);
}

.read-more:hover {
    background: linear-gradient(135deg, #00b8e6 0%, #007799 100%);
    transform: translateX(5px);
    box-shadow: 0 8px 25px rgba(0, 212, 255, 0.5);
}

.placeholder-text {
    color: #64748b;
    text-align: center;
    font-style: italic;
    font-size: 1.2rem;
    padding: 80px 20px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .section-title {
        font-size: 2rem;
    }

    .brand-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 25px;
    }

    .brand-card {
        width: 160px;
        height: 160px;
        padding: 20px 15px;
    }

    .logo-container {
        width: 100px;
        height: 100px;
    }

    .brand-section {
        padding: 50px 25px;
    }
}
</style>

<script>
function showBrandInfo(brand) {
    const infoBox = document.getElementById('brand-info');
    let info = '';

    switch (brand) {
        case 'toyota':
            info = `
                <h4>🚗 Toyota Motors</h4>
                <p>Toyota is a global leader in automotive innovation, offering advanced technology and hybrid solutions for sustainable mobility across the world.</p>
                <ul>
                    <li>70% increase in online sales (2024)</li>
                    <li>2M+ global customers served</li>
                    <li>Certified partner since 2018</li>
                    <li>5-star rated service experience</li>
                </ul>
                <a href="#" class="read-more">Read Full Story →</a>
            `;
            break;
        case 'lg':
            info = `
                <h4>📺 LG Electronics</h4>
                <p>LG continues to redefine innovation in electronics, providing top-quality home appliances and cutting-edge smart technology solutions worldwide.</p>
                <ul>
                    <li>500+ appliances listed online</li>
                    <li>1.2M monthly visitors</li>
                    <li>Strong digital customer growth</li>
                    <li>Best seller in Smart TV segment</li>
                </ul>
                <a href="#" class="read-more">Read Full Story →</a>
            `;
            break;
        case 'croma':
            info = `
                <h4>⚡ Croma Electronics</h4>
                <p>Croma delivers innovation and reliability in home appliances, recognized for quality and affordability.</p>
                <ul>
                    <li>500+ products in store</li>
                    <li>40% conversion rate boost</li>
                    <li>Top-ranked in customer satisfaction</li>
                    <li>Serving 1.5M+ happy customers</li>
                </ul>
                <a href="#" class="read-more">Read Full Story →</a>
            `;
            break;
        case 'prince':
            info = `
                <h4>💎 Prince Jewellery</h4>
                <p>Prince Jewellery is an iconic luxury brand offering high-end handcrafted jewellery collections with trust and legacy.</p>
                <ul>
                    <li>10K+ luxury products</li>
                    <li>92% customer satisfaction</li>
                    <li>Partner since 2020</li>
                    <li>Exclusive online collection launch 2024</li>
                </ul>
                <a href="#" class="read-more">Read Full Story →</a>
            `;
            break;
        default:
            info = `<p class="placeholder-text">✨ Click on a brand to explore detailed insights and success stories</p>`;
    }

    infoBox.innerHTML = info;

    // Smooth scroll to info box
    infoBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}
</script>

@endsection